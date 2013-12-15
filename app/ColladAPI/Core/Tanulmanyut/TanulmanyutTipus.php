<?php namespace ColladAPI\Core\Tanulmanyut;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class TanulmanyutTipus extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "tanulmanyut_tipus";

    protected $rootRelName = 'tanulmanyuttipus';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function tanulmanyutak() {
        return $this->hasMany('ColladAPI\\Core\\Tanulmanyut\\Tanulmanyut', 'tipus_id');
    }

}