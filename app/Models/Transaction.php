<?php

namespace App\Models;

use App\Models\Scopes\DestinationFeeScope;
use App\Models\Traits\WithStatuses;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Transaction extends Model
{
    use HasFactory;
    use WithStatuses;

    public $statuses = [
        '1' => 'pending',
        '2' => 'completed',
        '3' => 'canceled',
        '4' => 'returned',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contributor_id',
        'contributor_account',

        'txHash',
        'amount', //transaction amount
        'commission',
        'fee',
        'invested', //actual amount
        'status',

        'pool_id',
        'confirmation',
        'contributed',
        'collect',

        'errors',

        'chainid',
        'currency',
        'destination', // pool, fee
        'destination_account',
        'scope'
    ];

    protected $casts = [
        'confirmation' => 'array',
        'collect'=> 'json',
    ];

    protected static function booted(){
        static::addGlobalScope(new DestinationFeeScope());
    }

    public function contributor() {
        return $this->belongsTo(User::class, 'contributor_id');
    }

    public function pool() {
        return $this->belongsTo(Pool::class, 'pool_id');
    }

    public function scopeConfirmed(Builder $q) {
        return $q->where('transactions.status', 2);
    }

    public function getAmountAttribute()
    {
        return round($this->attributes['amount'],4);
    }

    /**
     * Get ALl Pending Transactions
     *
     * @return mixed
     */
    public function scopePending(Builder $q)
    {
        return $q->where('status', 1)->where('created_at', '<', Carbon::NOW()->subMinutes(3))->get();
    }
}
