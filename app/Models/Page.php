<?php

namespace App\Models;

use App\Models\Traits\VisibleTrait;
use App\Models\Traits\WithTranslationsTrait;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use Translatable;
    use VisibleTrait;
    use WithTranslationsTrait;

    public  $translatedAttributes = [
        'title',
        'description',

        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected $fillable = [
        'status',
        'slug',
    ];
}
