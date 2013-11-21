<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:05 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Beruhazas extends ColladEntity {

    protected $table = "beruhazas";

    protected $fillable = ['bevetel_id', 'tipus_id', 'osszeg', 'datum', 'leiras'];

    protected $rules = [
        'osszeg' => 'required|numeric',
        'datum' => 'required|date',
        'leiras' => 'alpha_num|max:512'
    ];

    public function bevetel() {
        return $this->belongsTo('ColladAPI\\Entities\\Bevetel');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\BeruhazasTipus');
    }

}