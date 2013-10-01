<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/29/13
 * Time: 9:22 PM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class PalyazatSzerepkor extends Model {

    protected $table = "palyazat_szerepkor";

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'nev' => 'required|alpha_num|between:2,256'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}