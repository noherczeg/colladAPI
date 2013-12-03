<?php namespace ColladAPI\Core\Palyazat;

use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class PalyazatTipus extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "palyazat_tipus";

    protected $rootRelName = 'palyazattipusok';

    protected $fillable = ['nev'];

    protected $rules = [
        'cime' => 'required|alpha_num|between:2,256'
    ];

    public function palyazatok() {
        return $this->hasMany('ColladAPI\\Core\\Palyazat\\Palyazat', 'tipus_id');
    }

}