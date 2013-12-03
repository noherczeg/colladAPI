<?php namespace ColladAPI\Core\Fokozat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Fokozat extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "fokozat";

    protected $rootRelName = 'fokozatok';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_has_fokozat', 'fokozat_id', 'szemely_id');
    }

    public function tudomanyTerulet() {
        return $this->belongsTo('ColladAPI\\Core\\Tudomanyterulet\\TudomanyTerulet', 'szemely_has_fokozat', 'tudomanyterulet_id', 'szemely_id');
    }

}