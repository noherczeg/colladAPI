<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:26 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Nyelv extends ColladEntity {

    protected $table = "nyelv";

    protected $fillable = ['nev', 'kod'];

    protected $rules = [
        'nev' => 'required|alpha|between:2,32',
        'kod' => 'required|alpha|size:2'
    ];

}