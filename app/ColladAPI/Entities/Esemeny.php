<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:20 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Esemeny extends Model {

    protected $table = "esemeny";

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\EsemenyTipus');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'esemeny_has_szemely', 'esemeny_id', 'szemely_id')->withPivot('megjegyzes');
    }

    public function szerepkorok() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szerepkor', 'esemeny_has_szemely', 'esemeny_id', 'szerepkor_id')->withPivot('megjegyzes');
    }

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Entities\\Palyazat', 'palyazat_has_esemeny', 'esemeny_id', 'palyazat_id');
    }

    public function kariTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'kari_esemeny_id');
    }

    public function oTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'otdk_esemeny_id');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'nev' => 'required|alpha_num|between:2,256',
            'kezdo_datum' => 'required|date',
            'vege_datum' => 'date',
            'leiras' => 'max:512',
            'helyszin' => 'max:256'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}