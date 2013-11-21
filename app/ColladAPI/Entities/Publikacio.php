<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:32 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Publikacio extends ColladEntity {

    protected $table = "publikacio";

    protected $fillable = [
        'tipus_id', 'nyelv_id', 'cim', 'datum', 'lektoralt', 'megjelenes_hely', 'megjelenes_kiado', 'oldalszam',
        'kotet', 'impaktfaktor', 'hivatkozas_fuggetlen', 'hivatkozas_fuggo', 'mtmt_id', 'megjegyzes'
    ];

    protected $rules = [
        'cim' => 'required|alpha_num|between:2,256',
        'datum' => 'required|date',
        'lektoralt' => 'required|integer',
        'megjelenes_hely' => 'max:256',
        'megjelenes_kiado' => 'max:256',
        'oldalszam' => 'integer',
        'kotet' => 'max:256',
        'impaktfaktor' => 'numeric',
        'hivatkozas_fuggetlen' => 'integer',
        'hivatkozas_fuggo' => 'integer',
        'mtmt_id' => 'max:64',
        'megjegyzes' => 'max:512',

    ];

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Entities\\Palyazat', 'palyazat_has_publikacio', 'publikacio_id', 'palyazat_id');
    }

    public function nyelv() {
        return $this->belongsTo('ColladAPI\\Entities\\Nyelv');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\PublikacioTipus');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'publikacio_has_szemely', 'publikacio_id', 'szemely_id');
    }

}