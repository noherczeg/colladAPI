<?php namespace ColladAPI\Core\Bevetel;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class BevetelTipus extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "bevetel_tipus";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function bevetelek() {
        return $this->hasMany('ColladAPI\\Core\\Bevetel\\Bevetel', 'tipus_id');
    }
}