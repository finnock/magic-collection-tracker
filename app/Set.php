<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $primaryKey = 'code';

    public $incrementing = false;

    protected $fillable = [
        'code',
        'gathererCode',
        'oldCode',
        'magicCardsInfoCode',
        'name',
        'releaseDate',
        'border',
        'type',
        'block',
        'onlineOnly',
        'cardCount'
    ];

    public $timestamps = false;

    public function cards()
    {
        return $this->hasMany('App\Card', 'setCode', 'code')->orderBy('number');
    }

    protected $table = 'sets';
}
