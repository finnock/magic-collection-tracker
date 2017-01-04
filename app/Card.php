<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'id',
        'setCode',
        'name',
        'number',
        'numberNumeric',
        'multiverseID',
        'imageName',
        'mciNumber',
        'meta',
        'manaCost',
        'convertedManaCost',
        'type',
        'rarity',
        'text',
        'flavor',
        'artist',
        'power',
        'toughness',
        'timeshifted'
    ];

    public $timestamps = false;

    public function set()
    {
        return $this->belongsTo('App\Set', 'setCode', 'code');
    }

    public function meta()
    {
        return json_decode($this->meta);
    }
}
