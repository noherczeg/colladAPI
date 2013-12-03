<?php namespace ColladAPI\Core\Kar;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Kar extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "kar";

    protected $rootRelName = 'karok';

    protected $fillable = ['nev'];

    protected $rules= [
        'nev' => 'required|alpha_num|between:2,127'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'kar_has_szemely', 'kar_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum');
    }

    public function intezetek() {
        return $this->belongsToMany('ColladAPI\\Core\\Intezet\\Intezet', 'kar_has_intezet', 'kar_id', 'intezet_id')->withPivot('kezdo_datum', 'vege_datum');
    }

    public function tanszekek() {
        return $this->belongsToMany('ColladAPI\\Core\\Tanszek\\Tanszek', 'kar_has_tanszek', 'kar_id', 'tanszek_id')->withPivot('kezdo_datum', 'vege_datum');
    }

}