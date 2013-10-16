<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:38 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class TDKDolgozat extends ColladEntity
{

    protected $table = "tdkdolgozat";

    protected $fillable = [
        'cim',
        'kari_tdk_szekcio_id',
        'kari_esemeny_id',
        'kari_pontszam',
        'kari_eredmeny',
        'kari_otdk_javasolt',
        'otdk_szekcio_id',
        'otdk_tagozat_id',
        'otdk_esemeny_id',
        'otdk_eredmeny',
        'resume',
        'megjegyzes'
    ];

    protected $rules = [
        'cim' => 'required|alpha_num|between:2,256',
        'kari_pontszam' => 'integer',
        'kari_eredmeny' => 'max:256',
        'kari_otdk_javasolt' => 'integer',
        'otdk_eredmeny' => 'max:256',
        'resume' => 'max:1024',
        'megjegyzes' => 'max:512'
    ];

    public function supervisedBySzemely()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'szemely_supervise_tdkdolgozat', 'tdkdolgozat_id', 'szemely_id');
    }

    public function kariEsemeny()
    {
        return $this->belongsTo('ColladAPI\\Entities\\Esemeny');
    }

    public function otdkEsemeny()
    {
        return $this->belongsTo('ColladAPI\\Entities\\Esemeny');
    }

    public function kariSzekcio()
    {
        return $this->belongsTo('ColladAPI\\Entities\\TDKDolgozatSzekcio');
    }

    public function otdkTagozat()
    {
        return $this->belongsTo('ColladAPI\\Entities\\TDKDolgozatTagozat');
    }
}