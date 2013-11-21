<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:07 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class BeruhazasTipus extends ColladEntity {

    protected $table = "beruhazas_tipus";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function beruhazasok() {
        return $this->hasMany('ColladAPI\\Entities\\Beruhazas', 'tipus_id');
    }

}