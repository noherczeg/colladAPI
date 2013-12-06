<?php namespace ColladAPI\Core\Intezet;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Intezet extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "intezet";

    protected $rootRelName = 'intezetek';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Core\\Bevetel\\Bevetel', 'intezet_id');
    }

    public function tanszekek() {
        return $this->belongsToMany('ColladAPI\\Core\\Tanszek\\Tanszek', 'intezet_has_tanszek', 'intezet_id', 'tanszek_id')->withPivot('kezdo_datum', 'vege_datum');
    }

    public function scopeWithAll($query)
    {
        return $query->with('bevetelek', 'tanszekek');
    }

}