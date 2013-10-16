<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:23 PM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class PalyazatTipus extends ColladEntity
{

    protected $table = "palyazat_tipus";

    protected $fillable = [
        'nev'
    ];

    protected $rules = [
        'cime' => 'required|alpha_num|between:2,256'
    ];

    public function palyazatok()
    {
        return $this->hasMany('ColladAPI\\Entities\\Palyazat', 'tipus_id');
    }
}