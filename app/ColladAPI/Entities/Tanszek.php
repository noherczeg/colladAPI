<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:41 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Tanszek extends Model {

    protected $table = "tanszek";

    protected $hidden  = ['pivot'];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_has_tanszek', 'tanszek_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Entities\\Bevetel', 'tanszek_id');
    }

    public function intezetek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Intezet', 'intezet_has_tanszek', 'tanszek_id', 'intezet_id')->withPivot('kezdo_datum', 'vege_datum');
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