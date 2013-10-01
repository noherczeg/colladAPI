<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:54 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class TDKDolgozatTagozat extends Model {

    protected $table = "tdkdolgozat_tagozat";

    public function oTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Entities\\TDKDolgozat', 'otdk_tagozat_id');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'nev' => 'required|alpha_num|between:2,256',
            'megjegyzes' => 'max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}