<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:34 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class PublikacioTipus extends ColladEntity {

    protected $table = "publikacio_tipus";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function publikaciok() {
        return $this->hasMany('ColladAPI\\Entities\\Publikacio', 'tipus_id');
    }

}