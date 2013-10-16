<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 12:17 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class KepzesSzint extends ColladEntity
{

    protected $table = "kepzesszint";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szakok()
    {
        return $this->hasMany('ColladAPI\\Entities\\Szak', 'kepzesszint_id');
    }
}