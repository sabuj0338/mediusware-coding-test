# Installation

## Please install required dependencies that laravel application depends on.

### Laravel current version is "laravel/framework": "^10.10"

1. Clone this repository and go to project directory
2. Then run this command to install composer packages
```bash
$ composer install
```
3. Then install node modules
```bash
$ npm install
$ npm run dev
```
4. Then copy .env.example file to .env

5. Edit .env file give the mysql database name, user, and password
6. Then migrate and seed database tables
```bash
$ php artisan migrate
```
7. Then finally run the application and open it default link: http://localhost:8000
```bash
$ php artisan serve
```

### Logics at a glance
```
  $user = User::find($request->user_id);

  $fee = 0;

  $isFriday = Carbon::now()->format('l') == "Friday" ? true : false;

  if ($user->account_type == 'individual') {
    if ($isFriday == false) {
      $thisMonthSum = Transaction::where('user_id', $user->id)->where('transaction_type', 'withdrawal')->whereMonth('date', '=', Carbon::now()->month)->sum('amount');
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
```