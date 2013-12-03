<?php namespace ColladAPI\Core\Nyelv;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Nyelv extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "nyelv";

    protected $rootRelName = 'nyelvek';

    protected $fillable = ['nev', 'kod'];

    protected $rules = [
        'nev' => 'required|alpha|between:2,32',
        'kod' => 'required|alpha|size:2'
    ];

}