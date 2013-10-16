<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:52 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class TanulmanyutTipus extends ColladEntity
{

    protected $table = "tanulmanyut_tipus";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function tanulmanyutak()
    {
        return $this->hasMany('ColladAPI\\Entities\\Tanulmanyut', 'tipus_id');
    }
}