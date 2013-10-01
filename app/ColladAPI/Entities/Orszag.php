<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 12:56 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Orszag extends Model {

    protected $table = "orszag";

    public function intezmenyek() {
        return $this->hasMany('ColladAPI\\Entities\\Intezmeny', 'orszag_id');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'nev' => 'required|alpha|between:2,64',
            'kod' => 'required|size:2|alpha'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}