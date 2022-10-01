<?php

namespace App\Models;

use App\Models\Traits\PositionSortedTrait;
use App\Models\Traits\VisibleTrait;
use App\Models\Traits\WithStatuses;
use App\Models\Traits\WithTranslationsTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pool extends Model
{
    use Translatable;
    use VisibleTrait;
    use WithTranslationsTrait;
    use PositionSortedTrait;
    use WithStatuses;

    public $statuses = [
        0 => 'new',
        1 => 'active',
        2 => 'pause',

        8 => 'ended',
        9 => 'closed'
    ];

    public  $translatedAttributes = [
        'title',
        'description',

        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected $fillable = [
        'status',
        'position',
        'uuid',

        'owner_id',
        'company_id',

        'address',
        'network',
        'currency',
        'amount',
        'supported',

        'contributed',
        'contributed_usd',
        'progress',

        'start_date',
        'end_date',

        'rules',
        'collect',
        'show_total_cap',
        'show_progress',
        'image',

        'title',
        'description',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',

        'rules' => 'json',
        'collect' => 'json',

        'supported' => 'array',
    ];

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function owner()
    {
        return $this->belongTo(User::class,'owner_id');
    }

    public function company(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function categories(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function getProgressAttribute() {
        return round((float)min(100,$this->attributes['progress']),2);
    }

    public function running()
    {
        return $this->attributes['status'] == 1;
    }
}
