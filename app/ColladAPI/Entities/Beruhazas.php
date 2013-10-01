<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:05 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Beruhazas extends Model {

    protected $table = "beruhazas";

    public function bevetel() {
        return $this->belongsTo('ColladAPI\\Entities\\Bevetel');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\BeruhazasTipus');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'osszeg' => 'required|numeric',
            'datum' => 'required|date',
            'leiras' => 'alpha_num|max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}