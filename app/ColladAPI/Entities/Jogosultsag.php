<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:17 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Jogosultsag extends Model {

    protected $table = "jogosultsag";

    public function csoportok() {
        return $this->belongsToMany('ColladAPI\\Entities\\Csoport', 'csoport_has_jogosultsag', 'jogosultsag_id', 'csoport_id');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'nev' => 'required|alpha_num|between:2,127',
            'leiras' => 'max:255'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}