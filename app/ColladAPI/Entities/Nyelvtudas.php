<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:29 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Nyelvtudas extends ColladEntity {

    protected $rules = [
        'bizonyitvany' => 'between:2,256',
        'datum' => 'date',
        'megjegyzes' => 'max:512'
    ];

    protected $table = "nyelvtudas";

    protected $fillable = ['szemely_id', 'nyelv_id', 'nyelvtudas_fok_id', 'bizonyitvany', 'datum', 'megjegyzes'];

    public function szemely() {
        return $this->belongsTo('ColladAPI\\Entities\\Szemely', 'szemely_id');
    }

    public function nyelv() {
        return $this->belongsTo('ColladAPI\\Entities\\Nyelv', 'nyelv_id');
    }

    public function nyelvtudasFok() {
        return $this->belongsTo('ColladAPI\\Entities\\NyelvtudasFok', 'nyelvtudas_fok_id');
    }

}