<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/26/13
 * Time: 2:03 AM
 */
namespace ColladAPI\Entities;

use ColladAPI\Entities\ColladEntity;

class Palyazat extends ColladEntity
{

    protected $table = "palyazat";

    protected $fillable = [
        'cime',
        'orszag_id',
        'tipus_id',
        'statusz_id',
        'konstrukcio',
        'vezeto',
        'osszeg_igenyelt',
        'osszeg_onero',
        'beadasi_datum',
        'kezdo_datum',
        'vege_datum',
        'leiras'
    ];

    protected $rules = [
        'cime' => 'required|alpha_num|between:2,256',
        'konstrukcio' => 'max:256',
        'vezeto' => 'integer',
        'osszeg_igenyelt' => 'numeric',
        'osszeg_onero' => 'numeric',
        'beadasi_datum' => 'date',
        'kezdo_datum' => 'date',
        'vege_datum' => 'date',
        'leiras' => 'max:512'
    ];

    public function bevetelek()
    {
        return $this->hasMany('ColladAPI\\Entities\\Bevetel', 'palyazat_id');
    }

    public function orszag()
    {
        return $this->belongsTo('ColladAPI\\Entities\\Orszag', 'orszag_id');
    }

    public function statusz()
    {
        return $this->belongsTo('ColladAPI\\Entities\\PalyazatStatusz', 'statusz_id');
    }

    public function tipus()
    {
        return $this->belongsTo('ColladAPI\\Entities\\PalyazatTipus', 'tipus_id');
    }

    public function alkotasok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Alkotas', 'palyazat_has_alkotas', 'palyazat_id', 'alkotas_id');
    }

    public function esemenyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Esemeny', 'palyazat_has_esemeny', 'palyazat_id', 'esemeny_id');
    }

    public function intezmenyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Intezmeny', 'palyazat_has_intezmeny', 'palyazat_id', 'intezmeny_id')->withPivot('felelos', 'megjegyzes');
    }

    public function publikaciok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Publikacio', 'palyazat_has_publikacio', 'palyazat_id', 'publikacio_id');
    }

    public function szemelyek()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\Szemely', 'palyazat_has_szemely', 'palyazat_id', 'szemely_id');
    }

    public function szerepkorok()
    {
        return $this->belongsToMany('ColladAPI\\Entities\\PalyazatSzerepkor', 'palyazat_has_szemely', 'palyazat_id', 'szerepkor_id')->withPivot('megjegyzes');
    }

    public function tudomanyteruletek()
    {
        return $this->belongsTo('ColladAPI\\Entities\\TudomanyTerulet', 'palyazat_has_tudomanyterulet', 'palyazat_id', 'tudomanyterulet_id');
    }
}