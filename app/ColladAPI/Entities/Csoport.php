<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:15 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Csoport extends ColladEntity
{

    protected $table = "csoport";

    protected $fillable = [
        'nev',
        'leiras'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,127',
        'leiras' => 'max:255'
    ];

    public function jogosultsagok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Jogosultsag', 'csoport_has_jogosultsag', 'csoport_id', 'jogosultsag_id');
    }

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_has_csoport', 'csoport_id', 'szemely_id');
    }
}