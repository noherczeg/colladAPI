<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:40 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Szervezet extends ColladEntity
{

    protected $table = "szervezet";

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'leiras' => 'max:512'
    ];

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_has_szervezet', 'szervezet_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function orszag()
    {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag');
    }

    public function szerepkor()
    {
        return $this->belongsTo('ColladAPI\\Entities\\SzervezetSzerepkor');
    }
}