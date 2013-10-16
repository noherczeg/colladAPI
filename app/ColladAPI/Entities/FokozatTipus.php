<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:13 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class FokozatTipus extends ColladEntity
{

    protected $table = "fokozat_tipus";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function fokozatok()
    {
        return $this->hasMany('ColladAPI\\Entities\\Fokozat', 'fokozat_tipus_id');
    }
}