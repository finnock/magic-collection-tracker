<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id',
        'layout',
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
        return json_decode($this->meta, true);
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('count');
    }

    public function imagePath()
    {
        $code = ($this->setCode == 'CON') ? 'CFX' : $this->setCode;
        $imageName = $this->imageName;
        return "/img/cards/$code/$imageName.jpg";
    }
}
