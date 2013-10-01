<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:27 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Intezmeny extends Model {

    protected $table = "intezmeny";

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szmeely_has_intezmeny', 'intezmeny_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Entities\\Palyazat', 'palyazat_has_intezmeny', 'intezmeny_id', 'palyazat_id')->withPivot('felelos', 'megjegyzes');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'nev' => 'required|alpha_num|between:2,256',
            'cim' => 'max:256',
            'leiras' => 'max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}