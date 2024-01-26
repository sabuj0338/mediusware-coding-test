<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  /**
   * Display the registration view.
   */
  public function dashboard(): View
  {
    $data = [];

    $data['allTransactions'] = Transaction::with('user')->latest()->paginate(7);

    return view('dashboard', $data);

  }
}
