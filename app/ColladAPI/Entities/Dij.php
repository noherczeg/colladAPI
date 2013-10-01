<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:18 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Dij extends Model {

    protected $table = "dij";

    public function szemely() {
        return $this->belongsTo('ColladAPI\\Entities\\Szemely');
    }

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'megnevezes' => 'required|alpha_num|between:2,256',
            'datum' => 'required|date',
            'leiras' => 'max:512',
            'adomanyozo' => 'alpha_num|max:256'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}