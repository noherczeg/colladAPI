<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:23 AM
 */

namespace ColladAPI\Entities;

use Illuminate\Database\Eloquent\Model;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Support\Facades\Validator;

class EsemenySzerepkor extends Model {

    protected $table = "esemeny_szerepkor";

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'esemeny_has_szemely', 'esemeny_szerepkor_id', 'szemely_id');
    }

    public function esemenyek() {
        return $this->belongsToMany('ColladAPI\\Entities\\Esemeny', 'esemeny_has_szemely', 'esemeny_szerepkor_id', 'esemeny_id');
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