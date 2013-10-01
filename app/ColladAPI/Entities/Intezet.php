<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:27 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Intezet extends Model {

    protected $table = "intezet";

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Entities\\Bevetel', 'intezet_id');
    }

    public function tanszekek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Tanszek', 'intezet_has_tanszek', 'intezet_id', 'tanszek_id')->withPivot('kezdo_datum', 'vege_datum');
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