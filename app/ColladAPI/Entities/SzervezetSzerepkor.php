<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:49 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class SzervezetSzerepkor extends Model {

    protected $table = "szervezet_szerepkor";

    public function szervezetek() {
        return $this->hasMany('ColladAPI\\Entities\\Szervezet', 'szerepkor_id');
    }

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