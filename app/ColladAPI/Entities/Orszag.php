<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 12:56 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Orszag extends ColladEntity
{

    protected $table = "orszag";

    protected $fillable = [
        'nev',
        'kod'
    ];

    protected $rules = [
        'nev' => 'required|alpha|between:2,64',
        'kod' => 'required|size:2|alpha'
    ];

    public function intezmenyek()
    {
        return $this->hasMany('ColladAPI\\Entities\\Intezmeny', 'orszag_id');
    }
}