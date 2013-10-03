<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 12:57 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Alkotas extends ColladEntity {

    protected $table = "alkotas";

    protected $fillable = ['tipus_id', 'nev', 'datum', 'leiras', 'mtmt_id', 'megjegyzes'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'datum' => 'required|date',
        'leiras' => 'max:512',
        'mtmt_id' => 'max:64',
        'megjegyzes' => 'max:512'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'alkotas_has_szemely', 'alkotas_id', 'szemely_id')->withPivot('szemely_sorrend');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\AlkotasTipus');
    }

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Entities\\Palyazat', 'palyazat_has_alkotas', 'alkotas_id', 'palyazat_id');
    }

}