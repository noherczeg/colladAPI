<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 1:43 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Fokozat extends ColladEntity
{

    protected $table = "fokozat";

    protected $fillable = [
        'szemely_id',
        'fokozat_tipus_id',
        'tudomanyterulet_id',
        'dolgozat_cime',
        'datum',
        'intezmeny',
        'megjegyzes'
    ];

    protected $rules = [
        'dolgozat_cime' => 'required|alpha_num|between:2,256',
        'datum' => 'date',
        'intezmeny' => 'max:256',
        'megjegyzes' => 'max:512'
    ];

    public function szemely()
    {
        return $this->belongsTo('ColladAPI\\Entities\\Szemely');
    }

    public function tipus()
    {
        return $this->belongsTo('ColladAPI\\Entities\\FokozatTipus');
    }

    public function tudomanyTerulet()
    {
        return $this->belongsTo('ColladAPI\\Entities\\TudomanyTerulet');
    }

    public function supervisedBySzemely()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_supervise_fokozat', 'fokozat_id', 'szemely_id');
    }
}