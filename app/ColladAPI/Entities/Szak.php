<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/25/13
 * Time: 11:54 PM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Szak extends ColladEntity
{

    protected $table = 'szak';

    protected $fillable = [
        'nev',
        'kepzesszint_id'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    protected $hidden = [
        'pivot'
    ];

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_has_szak', 'szak_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function kepzesszint()
    {
        return $this->belongsTo('ColladAPI\\Entities\\KepzesSzint');
    }
}