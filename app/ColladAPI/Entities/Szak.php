<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/25/13
 * Time: 11:54 PM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Szak extends Model {

    protected $table = 'szak';

    protected $hidden  = ['pivot'];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_has_szak', 'szak_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function kepzesszint() {
        return $this->belongsTo('ColladAPI\\Entities\\KepzesSzint');
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