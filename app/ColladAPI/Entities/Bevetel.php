<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:09 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Bevetel extends ColladEntity {

    protected $table = "bevetel";

    protected $fillable = ['osszeg', 'datum', 'tipus_id', 'leiras', 'palyazat_id', 'tanszek_id', 'intezet_id'];

    protected $rules = [
        'osszeg' => 'required|numeric',
        'datum' => 'required|date',
        'leiras' => 'required|max:512'
    ];

    public function beruhazasok() {
        return $this->hasMany('ColladAPI\\Entities\\Beruhazas', 'bevetel_id');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\BevetelTipus');
    }

    public function palyazat() {
        return $this->belongsTo('ColladAPI\\Entities\\Palyazat');
    }

    public function tanszek() {
        return $this->belongsTo('ColladAPI\\Entities\\Tanszek');
    }

    public function intezet() {
        return $this->belongsTo('ColladAPI\\Entities\\Intezet');
    }

}