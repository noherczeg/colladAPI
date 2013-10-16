<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:17 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Jogosultsag extends ColladEntity
{

    protected $table = "jogosultsag";

    protected $fillable = [
        'nev',
        'leiras'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,127',
        'leiras' => 'max:255'
    ];

    public function csoportok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Csoport', 'csoport_has_jogosultsag', 'jogosultsag_id', 'csoport_id');
    }
}