<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:15 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class TudomanyTerulet extends Model {

    protected $table = "tudomanyterulet";

    public function fokozatok() {
        return $this->hasMany('ColladAPI\\Entities\\Fokozat', 'tudomanyterulet_id');
    }

    public function palyazatok() {
        return $this->belongsTo('ColladAPI\\Entities\\Palyazat', 'palyazat_has_tudomanyterulet', 'tudomanyterulet_id', 'palyazat_id');
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