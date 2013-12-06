<?php namespace ColladAPI\Core\Intezmeny;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Intezmeny extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "intezmeny";

    protected $rootRelName = 'intezmenyek';

    protected $fillable = ['nev', 'cim', 'leiras', 'orszag_id'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'cim' => 'max:256',
        'leiras' => 'max:512'
    ];

    public function orszag() {
        return $this->belongsTo('ColladAPI\\Core\\Orszag\\Orszag');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_has_intezmeny', 'intezmeny_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Core\\Palyazat\\Palyazat', 'palyazat_has_intezmeny', 'intezmeny_id', 'palyazat_id')->withPivot('felelos', 'megjegyzes');
    }

    public function scopeWithAll($query)
    {
        return $query->with('orszag', 'szemelyek', 'palyazatok');
    }

}