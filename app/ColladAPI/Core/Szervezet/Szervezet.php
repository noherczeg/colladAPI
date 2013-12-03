<?php namespace ColladAPI\Core\Szervezet;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Szervezet extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "szervezet";

    protected $rootRelName = 'szervezetek';

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'leiras' => 'max:512'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_has_szervezet', 'szervezet_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Core\\Orszag\\Orszag');
    }

    public function szerepkor() {
        return $this->belongsTo('ColladAPI\\Core\\Szervezet\\SzervezetSzerepkor');
    }

    /**
     * Scope metodus az entitas osszes relaciojanak "felcsatolasara"
     *
     * @param $query
     * @return mixed
     */
    public function scopeWithAll($query)
    {
        return $query->with('orszag', 'szerepkor', 'szemelyek');
    }

}