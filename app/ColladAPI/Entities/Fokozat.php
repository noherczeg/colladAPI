<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:13 AM
 */

namespace ColladAPI\Entities;

class Fokozat extends ColladEntity {

    protected $table = "fokozat";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_has_fokozat', 'fokozat_id', 'szemely_id');
    }

    public function tudomanyTerulet() {
        return $this->belongsTo('ColladAPI\\Entities\\TudomanyTerulet', 'szemely_has_fokozat', 'tudomanyterulet_id', 'szemely_id');
    }

}