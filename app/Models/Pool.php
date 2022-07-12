<?php

namespace App\Models;

use App\Models\Traits\PositionSortedTrait;
use App\Models\Traits\VisibleTrait;
use App\Models\Traits\WithTranslationsTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use Translatable;
    use VisibleTrait;
    use WithTranslationsTrait;
    use PositionSortedTrait;

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
        'slug',

        'owner_id',
        'company_id',

        'address',
        'network',
        'coin',

        'amount',
        'date_start',
        'date_end',

        'setting_contact',
        'setting_display',
    ];

    protected $casts = [
        'date_start' => 'datetime',
        'date_end' => 'datetime',

        'setting_contact' => 'json',
        'setting_display' => 'json',
    ];

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
}
