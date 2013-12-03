<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class PalyazatSzerepkor extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "palyazat_szerepkor";

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

}