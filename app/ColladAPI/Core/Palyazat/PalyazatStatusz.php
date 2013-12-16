<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class PalyazatStatusz extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "palyazat_statusz";

    protected $rootRelName = 'palyazatstatuszok';

    protected $fillable = ['nev'];

    protected $rules = [
        'nev' => 'required|alpha_num|between:2,256'
    ];

    public function palyazatok() {
        return $this->hasMany('ColladAPI\\Core\\Palyazat\\Palyazat', 'statusz_id');
    }

}