<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:15 AM
 */

namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class TudomanyTerulet extends ColladEntity {

    protected $table = "tudomanyterulet";

    protected $rootRelName = 'tudomanyteruletek';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function fokozatok() {
        return $this->hasMany('ColladAPI\\Entities\\Fokozat', 'tudomanyterulet_id');
    }

    public function palyazatok() {
        return $this->belongsTo('ColladAPI\\Entities\\Palyazat', 'palyazat_has_tudomanyterulet', 'tudomanyterulet_id', 'palyazat_id');
    }
}