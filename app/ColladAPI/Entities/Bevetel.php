<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:09 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Bevetel extends Model {

    protected $table = "bevetel";

    public function beruhazasok() {
        return $this->hasMany('ColladAPI\\Entities\\Beruhazas', 'bevetel_id');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\BevetelTipus');
    }

    public function palyazat() {
        return $this->belongsTo('ColladAPI\\Entities\\Palyazat');
    }

    public function tanszek() {
        return $this->belongsTo('ColladAPI\\Entities\\Tanszek');
    }

    public function intezet() {
        return $this->belongsTo('ColladAPI\\Entities\\Intezet');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'osszeg' => 'required|numeric',
            'datum' => 'required|date',
            'leiras' => 'required|max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}