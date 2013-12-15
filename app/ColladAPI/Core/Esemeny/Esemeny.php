<?php namespace ColladAPI\Core\Esemeny;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Esemeny extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "esemeny";

    protected $rootRelName = 'esemenyek';

    protected $fillable = ['tipus_id', 'nev', 'kezdo_datum', 'vege_datum', 'helyszin', 'leiras'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'kezdo_datum' => 'required|date',
        'vege_datum' => 'date',
        'leiras' => 'max:512',
        'helyszin' => 'max:256'
    ];

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Core\\Esemeny\\EsemenyTipus');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'esemeny_has_szemely', 'esemeny_id', 'szemely_id')->withPivot('megjegyzes');
    }

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Core\\Palyazat\\Palyazat', 'palyazat_has_esemeny', 'esemeny_id', 'palyazat_id');
    }

    public function kariTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Core\\TDKDolgozat\\TDKDolgozat', 'kari_esemeny_id');
    }

    public function oTDKDolgozatok() {
        return $this->hasMany('ColladAPI\\Core\\TDKDolgozat\\TDKDolgozat', 'otdk_esemeny_id');
    }

    public function scopeWithAll($query)
    {
        return $query->with('tipus', 'szemelyek', 'palyazatok', 'kariTDKDolgozatok', 'oTDKDolgozatok');
    }

    public function attachDown()
    {
        return $this->load('tipus');
    }

    public function attachUp()
    {
        return $this->load('szemelyek');
    }

}