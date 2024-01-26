<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
  /**
   * Display a listing of the deposit list resource.
   */
  public function depositList(): View
  {
    $data = [];

    $data['depositList'] = Transaction::with('user')->where('transaction_type', 'deposit')->latest()->paginate(10);

    return view('transactions.deposit', $data);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function storeDeposit(Request $request)
  {
    $request->validate([
      'user_id' => ['required', 'integer', 'exists:users,id'],
      'amount' => ['required', 'integer'],
    ]);

    Transaction::create([
      'user_id' => $request->user_id,
      'amount' => $request->amount,
      'transaction_type' => 'deposit',
      'date' => Carbon::now(),
    ]);

    $user = User::find($request->user_id);

    $user->balance = $user->balance + $request->amount;
    $user->save();

    return Redirect::to('/deposit');
  }

  /**
   * Display a listing of the withdrawal list resource.
   */
  public function withdrawalList(): View
  {
    $data = [];

    $data['withdrawalList'] = Transaction::with('user')->where('transaction_type', 'withdrawal')->latest()->paginate(10);

    return view('transactions.withdrawal', $data);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function storeWithdrawal(Request $request)
  {
    // dd(Carbon::now()->format('l'));
    $request->validate([
      'user_id' => ['required', 'integer', 'exists:users,id'],
      'amount' => ['required', 'integer'],
    ]);

    $user = User::find($request->user_id);

    $fee = 0;

    $isFriday = Carbon::now()->format('l') == "Friday" ? true : false;

    if ($user->account_type == 'individual') {
      if ($isFriday == false) {
        $thisMonthSum = Transaction::where('user_id', $user->id)->where('transaction_type', 'deposit')->whereMonth('date', '=', Carbon::now()->month)->sum('amount');
        // $lastMonthSum = Transaction::where('user_id', $user->id)->whereMonth('date', '=', Carbon::now()->subMonth()->month)->sum('amount');

        if($thisMonthSum >= 5000) {
          if($request->amount >= 1000) {
            $amount = ($request->amount - 1000);
            $fee = ($amount * 0.015) / 100;
          } else {
            $fee = ($request->amount * 0.015) / 100;
          }
        }
      }
    } else if ($user->account_type == 'business') {
      $totalWithdrawal = Transaction::where('user_id', $user->id)->where('transaction_type', 'withdrawal')->sum('amount');

      if($totalWithdrawal >= 50000) {
        $fee = ($request->amount * 0.015) / 100;
      } else {
        $fee = ($request->amount * 0.025) / 100;
      }
    }

    Transaction::create([
      'user_id' => $request->user_id,
      'amount' => $request->amount,
      'fee' => $fee,
      'transaction_type' => 'withdrawal',
      'date' => Carbon::now(),
    ]);

    $user->balance = $user->balance - ($request->amount + $fee);
    $user->save();

    return Redirect::to('/withdrawal');
  }
}
