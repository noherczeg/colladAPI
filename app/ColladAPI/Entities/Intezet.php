<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:27 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Intezet extends ColladEntity {

    protected $table = "intezet";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Entities\\Bevetel', 'intezet_id');
    }

    public function tanszekek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Tanszek', 'intezet_has_tanszek', 'intezet_id', 'tanszek_id')->withPivot('kezdo_datum', 'vege_datum');
    }

}