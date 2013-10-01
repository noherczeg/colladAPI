<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:29 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class Nyelvtudas extends Model {

    protected $table = "nyelvtudas";

    public function szemely() {
        return $this->belongsTo('ColladAPI\\Entities\\Szemely');
    }

    public function nyelv() {
        return $this->belongsTo('ColladAPI\\Entities\\Nyelv');
    }

    public function nyelvtudasFok() {
        return $this->belongsTo('ColladAPI\\Entities\\NyelvtudasFok');
    }

    public function validate()
    {
        $validator = Validator::make($this->attributes, [
            'bizonyitvany' => 'between:2,256',
            'datum' => 'date',
            'megjegyzes' => 'max:512'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

}