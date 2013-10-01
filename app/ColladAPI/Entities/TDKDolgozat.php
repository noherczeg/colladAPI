<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:38 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class TDKDolgozat extends Model {

    protected $table = "tdkdolgozat";

    public function supervisedBySzemely() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_supervise_tdkdolgozat', 'tdkdolgozat_id', 'szemely_id');
    }

    public function kariEsemeny() {
        return $this->belongsTo('ColladAPI\\Entities\\Esemeny');
    }

    public function otdkEsemeny() {
        return $this->belongsTo('ColladAPI\\Entities\\Esemeny');
    }

    public function kariSzekcio() {
        return $this->belongsTo('ColladAPI\\Entities\\TDKDolgozatSzekcio');
    }

    public function otdkTagozat() {
        return $this->belongsTo('ColladAPI\\Entities\\TDKDolgozatTagozat');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'cim' => 'required|alpha_num|between:2,256',
            'kari_pontszam' => 'integer',
            'kari_eredmeny' => 'max:256',
            'kari_otdk_javasolt' => 'integer',
            'otdk_eredmeny' => 'max:256',
            'resume' => 'max:1024',
            'megjegyzes' => 'max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}