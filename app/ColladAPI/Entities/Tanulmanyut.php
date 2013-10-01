<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:53 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Tanulmanyut extends Model {

    protected $table = "tanulmanyut";

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\TanulmanyutTipus');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'tanulmanyut_has_szemely', 'tanulmanyut_id', 'szemely_id');
    }

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'intezmeny' => 'alpha_num|between:2,256',
            'kezdo_datum' => 'required|date',
            'vege_datum' => 'date',
            'leiras' => 'max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}