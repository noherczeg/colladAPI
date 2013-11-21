<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:49 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class SzervezetSzerepkor extends ColladEntity {

    protected $table = "szervezet_szerepkor";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szervezetek() {
        return $this->hasMany('ColladAPI\\Entities\\Szervezet', 'szerepkor_id');
    }
}