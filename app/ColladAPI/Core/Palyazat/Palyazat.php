<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Palyazat extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "palyazat";

    protected $rootRelName = 'palyazatok';

    protected $fillable = [
        'cime', 'orszag_id', 'tipus_id', 'statusz_id', 'konstrukcio', 'vezeto', 'osszeg_igenyelt', 'osszeg_onero',
        'beadasi_datum', 'kezdo_datum', 'vege_datum', 'leiras'
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

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Core\\Bevetel\\Bevetel', 'palyazat_id');
    }

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Core\\Orszag\\Orszag', 'orszag_id');
    }

    public function statusz() {
        return $this->belongsTo('ColladAPI\\Core\\Palyazat\\PalyazatStatusz', 'statusz_id');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Core\\Palyazat\\PalyazatTipus', 'tipus_id');
    }

    public function alkotasok() {
        return $this->belongsToMany('ColladAPI\\Core\\Alkotas\\Alkotas', 'palyazat_has_alkotas', 'palyazat_id', 'alkotas_id');
    }

    public function esemenyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Esemeny\\Esemeny', 'palyazat_has_esemeny', 'palyazat_id', 'esemeny_id');
    }

    public function intezmenyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Intezmeny\\Intezmeny', 'palyazat_has_intezmeny', 'palyazat_id', 'intezmeny_id')->withPivot('felelos', 'megjegyzes');
    }

    public function publikaciok() {
        return $this->belongsToMany('ColladAPI\\Core\\Publikacio\\Publikacio', 'palyazat_has_publikacio', 'palyazat_id', 'publikacio_id');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'palyazat_has_szemely', 'palyazat_id', 'szemely_id');
    }

    public function szerepkorok() {
        return $this->belongsToMany('ColladAPI\\Core\\Palyazat\\PalyazatSzerepkor', 'palyazat_has_szemely', 'palyazat_id', 'szerepkor_id')->withPivot('megjegyzes');
    }

    public function tudomanyteruletek() {
        return $this->belongsTo('ColladAPI\\Core\\Tudomanyterulet\\TudomanyTerulet', 'palyazat_has_tudomanyterulet', 'palyazat_id', 'tudomanyterulet_id');
    }

}