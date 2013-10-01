<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:26 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Nyelv extends Model {

    protected $table = "nyelv";

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'nev' => 'required|alpha|between:2,32',
            'kod' => 'required|alpha|size:2'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}