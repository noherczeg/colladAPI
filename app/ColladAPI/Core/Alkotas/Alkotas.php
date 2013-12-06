<?php namespace ColladAPI\Core\Alkotas;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Alkotas extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "alkotas";

    protected $rootRelName = 'alkotasok';

    protected $fillable = ['tipus_id', 'nev', 'datum', 'leiras', 'mtmt_id', 'megjegyzes'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256',
        'datum' => 'required|date',
        'leiras' => 'max:512',
        'mtmt_id' => 'max:64',
        'megjegyzes' => 'max:512'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'alkotas_has_szemely', 'alkotas_id', 'szemely_id')->withPivot('szemely_sorrend');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Core\\Alkotas\\AlkotasTipus');
    }

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Core\\Palyazat\\Palyazat', 'palyazat_has_alkotas', 'alkotas_id', 'palyazat_id');
    }

    /**
     * Scope metodus az entitas osszes relaciojanak "felcsatolasara"
     *
     * @param $query
     * @return Builder
     */
    public function scopeWithAll($query)
    {
        return $query->with('szemelyek', 'tipus', 'palyazatok');
    }

}