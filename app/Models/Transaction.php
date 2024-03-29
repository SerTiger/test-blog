<?php

namespace App\Models;

use App\Models\Scopes\DestinationFeeScope;
use App\Models\Scopes\DraftScope;
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
        '0' => 'draft',
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
        'amount', //transaction amount in eth
        'amount_usd',
        'amount_native', //transaction amount
        'commission',
        'fee',
        'invested', //actual amount in usd
        'status',

        'pool_id',
        'confirmation',
        'contributed',
        'contributed_usd',
        'collect',

        'errors',

        'chainid',
        'currency',
        'symbol',
        'destination', // pool, fee
        'destination_account',
        'scope',

        'revert_txHash',
        'revert_amount',
    ];

    protected $casts = [
        'confirmation' => 'array',
        'collect'=> 'json',
    ];

    protected static function booted(){
        static::addGlobalScope(new DestinationFeeScope());
        static::addGlobalScope(new DraftScope());
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
        return round($this->attributes['amount'],8);
    }

    /**
     * Get ALl Pending Transactions
     *
     * @return mixed
     */
    public function scopePending(Builder $q, $withoutDelay = false)
    {
        return $q->where('transactions.status','=', 1)
            ->when(!$withoutDelay, function($q) {
                return $q->where('transactions.created_at', '<', Carbon::NOW()->subMinutes(1));
            });
    }

    /**
     * Get ALl Pending Transactions
     *
     * @return mixed
     */
    public function scopeDraft(Builder $q)
    {
        return $q->where('transactions.status', '=',0)
            ->where('transactions.created_at', '<', Carbon::NOW()->subMinutes(2*60));
    }

    public function getContributorAddressMaskedAttribute() {

        return implode('...',[substr($this->contributor_account,0,5),substr($this->contributor_account,-4)]);
    }

    public function getDestinationAddressMaskedAttribute() {

        return implode('...',[substr($this->destination_account,0,5),substr($this->destination_account,-4)]);
    }
}
