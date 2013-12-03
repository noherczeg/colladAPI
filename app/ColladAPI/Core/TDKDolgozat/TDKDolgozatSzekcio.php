<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:54 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class TDKDolgozatSzekcio extends ColladEntity {

    protected $table = "tdkdolgozat_szekcio";

    protected $fillable = ['nev', 'megjegyzes'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'megjegyzes' => 'max:512'
    ];

    public function kariTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'kari_tdk_szekcio_id');
    }

    public function oTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'otdk_szekcio_id');
    }

}