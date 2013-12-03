<?php namespace ColladAPI\Core\Tanszek;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Tanszek extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "tanszek";

    protected $rootRelName = 'tanszekek';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'szemely_has_tanszek', 'tanszek_id', 'szemely_id')->withPivot('kezdo_datum', 'vege_datum', 'megjegyzes');
    }

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Core\\Bevetel\\Bevetel', 'tanszek_id');
    }

    public function intezetek() {
        return $this->belongsToMany('ColladAPI\\Core\\Intezet\\Intezet', 'intezet_has_tanszek', 'tanszek_id', 'intezet_id')->withPivot('kezdo_datum', 'vege_datum');
    }

}