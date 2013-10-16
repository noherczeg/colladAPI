<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:27 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Intezmeny extends ColladEntity
{

    protected $table = "intezmeny";

    protected $fillable = [
        'nev',
        'cim',
        'leiras',
        'orszag_id'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'cim' => 'max:256',
        'leiras' => 'max:512'
    ];

    public function orszag()
    {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag');
    }

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szmeely_has_intezmeny', 'intezmeny_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function palyazatok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Palyazat', 'palyazat_has_intezmeny', 'intezmeny_id', 'palyazat_id')->withPivot('felelos', 'megjegyzes');
    }
}