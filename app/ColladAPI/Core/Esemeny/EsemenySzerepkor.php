<?php namespace ColladAPI\Core\Esemeny;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class EsemenySzerepkor extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "esemeny_szerepkor";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'esemeny_has_szemely', 'esemeny_szerepkor_id', 'szemely_id');
    }

    public function esemenyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Esemeny\\Esemeny', 'esemeny_has_szemely', 'esemeny_szerepkor_id', 'esemeny_id');
    }
}