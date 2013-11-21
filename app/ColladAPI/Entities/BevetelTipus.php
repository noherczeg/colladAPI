<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:10 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class BevetelTipus extends ColladEntity {

    protected $table = "bevetel_tipus";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Entities\\Bevetel', 'tipus_id');
    }
}