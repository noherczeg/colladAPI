<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/3/13
 * Time: 6:08 PM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Kar extends ColladEntity
{

    protected $table = "kar";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,127'
    ];

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'kar_has_szemely', 'kar_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum');
    }

    public function intezetek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Intezet', 'kar_has_intezet', 'kar_id', 'intezet_id')->withPivot('kezdo_datum', 'vege_datum');
    }

    public function tanszekek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Tanszek', 'kar_has_tanszek', 'kar_id', 'tanszek_id')->withPivot('kezdo_datum', 'vege_datum');
    }
}