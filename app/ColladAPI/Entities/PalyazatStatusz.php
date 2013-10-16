<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:27 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class PalyazatStatusz extends ColladEntity
{

    protected $table = "palyazat_statusz";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function palyazatok()
    {
        return $this->hasMany('ColladAPI\\Entities\\Palyazat', 'statusz_id');
    }
}