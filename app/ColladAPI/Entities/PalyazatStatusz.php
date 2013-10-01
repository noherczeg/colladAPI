<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:27 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class PalyazatStatusz extends Model {

    protected $table = "palyazat_statusz";

    public function palyazatok() {
        return $this->hasMany('ColladAPI\\Entities\\Palyazat', 'statusz_id');
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