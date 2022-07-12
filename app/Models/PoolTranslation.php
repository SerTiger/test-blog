<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoolTranslation extends Model
{
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];
}
