<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:22 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class NyelvtudasFok extends ColladEntity {

    protected $table = "nyelvtudas_fok";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function nyelvtudasok() {
        return $this->hasMany('ColladAPI\\Entities\\Nyelvtudas', 'nyelvtudas_fok_id');
    }
}