<?php namespace ColladAPI\Core\TDKDolgozat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class TDKDolgozat extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "tdkdolgozat";

    protected $rootRelName = 'tdkdolgozatok';

    protected $fillable = [
        'cim', 'kari_tdk_szekcio_id', 'kari_esemeny_id', 'kari_pontszam', 'kari_eredmeny', 'kari_otdk_javasolt',
        'otdk_szekcio_id', 'otdk_tagozat_id', 'otdk_esemeny_id', 'otdk_eredmeny', 'resume', 'megjegyzes'
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

    public function supervisedBySzemely() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_supervise_tdkdolgozat', 'tdkdolgozat_id', 'szemely_id');
    }

    public function kariEsemeny() {
        return $this->belongsTo('ColladAPI\\Core\\Esemeny\\Esemeny');
    }

    public function otdkEsemeny() {
        return $this->belongsTo('ColladAPI\\Core\\Esemeny\\Esemeny');
    }

    public function kariSzekcio() {
        return $this->belongsTo('ColladAPI\\Core\\TDKDolgozat\\TDKDolgozatSzekcio');
    }

    public function otdkTagozat() {
        return $this->belongsTo('ColladAPI\\Core\\TDKDolgozat\\TDKDolgozatTagozat');
    }

    public function scopeWithAll($query)
    {
        return $query->with('kariSzekcio', 'otdkTagozat', 'otdkEsemeny', 'kariEsemeny');
    }

}