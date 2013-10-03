<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:21 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class EsemenyTipus extends ColladEntity {

    protected $table = "esemeny_tipus";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function alkotasok() {
        return $this->hasMany('ColladAPI\\Entities\\Esemeny', 'tipus_id');
    }

}