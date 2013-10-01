<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:32 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Publikacio extends Model {

    protected $table = "publikacio";

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Entities\\Palyazat', 'palyazat_has_publikacio', 'publikacio_id', 'palyazat_id');
    }

    public function nyelv() {
        return $this->belongsTo('ColladAPI\\Entities\\Nyelv');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\PublikacioTipus');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'publikacio_has_szemely', 'publikacio_id', 'szemely_id');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'cim' => 'required|alpha_num|between:2,256',
            'datum' => 'required|date',
            'lektoralt' => 'required|integer',
            'megjelenes_hely' => 'max:256',
            'megjelenes_kiado' => 'max:256',
            'oldalszam' => 'integer',
            'kotet' => 'max:256',
            'impaktfaktor' => 'numeric',
            'hivatkozas_fuggetlen' => 'integer',
            'hivatkozas_fuggo' => 'integer',
            'mtmt_id' => 'max:64',
            'megjegyzes' => 'max:512',

        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}