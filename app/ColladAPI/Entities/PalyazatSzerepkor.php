<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/29/13
 * Time: 9:22 PM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class PalyazatSzerepkor extends ColladEntity
{

    protected $table = "palyazat_szerepkor";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];
}