<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'user_id',
      'transaction_type',
      'amount',
      'fee',
      'date',
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
      // 'email_verified_at' => 'datetime',
      // 'password' => 'hashed',
    ];

    public function user(): BelongsTo
    {
      return $this->belongsTo(User::class, 'user_id');
    }
}
