<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:53 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Tanulmanyut extends ColladEntity
{

    protected $table = "tanulmanyut";

    protected $fillable = [
        'tipus_id',
        'orszag_id',
        'kezdo_datum',
        'vege_datum',
        'intezmeny',
        'leiras'
    ];

    protected $rules = [
        'intezmeny' => 'alpha_num|between:2,256',
        'kezdo_datum' => 'required|date',
        'vege_datum' => 'date',
        'leiras' => 'max:512'
    ];

    public function tipus()
    {
        return $this->belongsTo('ColladAPI\\Entities\\TanulmanyutTipus');
    }

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'tanulmanyut_has_szemely', 'tanulmanyut_id', 'szemely_id');
    }

    public function orszag()
    {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag');
    }
}