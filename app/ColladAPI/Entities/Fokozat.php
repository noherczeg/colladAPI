<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:43 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Fokozat extends Model {

    protected $table = "fokozat";

    public function szemely() {
        return $this->belongsTo('ColladAPI\\Entities\\Szemely');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Entities\\FokozatTipus');
    }

    public function tudomanyTerulet() {
        return $this->belongsTo('ColladAPI\\Entities\\TudomanyTerulet');
    }

    public function supervisedBySzemely() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_supervise_fokozat', 'fokozat_id', 'szemely_id');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'dolgozat_cime' => 'required|alpha_num|between:2,256',
            'datum' => 'date',
            'intezmeny' => 'max:256',
            'megjegyzes' => 'max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}