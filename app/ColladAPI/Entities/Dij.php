<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:18 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Dij extends ColladEntity {

    protected $table = "dij";

    protected $fillable = ['szemely_id', 'orszag_id', 'megnevezes', 'datum', 'adomanyozo', 'leiras'];

    protected $rules = [
        'megnevezes' => 'required|alpha_num|between:2,256',
        'datum' => 'required|date',
        'leiras' => 'max:512',
        'adomanyozo' => 'alpha_num|max:256'
    ];

    public function szemely() {
        return $this->belongsTo('ColladAPI\\Entities\\Szemely');
    }

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag');
    }

}