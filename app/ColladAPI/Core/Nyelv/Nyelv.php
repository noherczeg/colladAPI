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

    public function publikaciok() {
        return $this->hasMany('ColladAPI\\Core\\Publikacio\\Publikacio');
    }

    public function nyelvtudasok() {
        return $this->hasMany('ColladAPI\\Core\\Nyelv\\Nyelvtudas');
    }

    public function scopeWithAll($query)
    {
        return $query->with('publikaciok', 'nyelvtudasok');
    }

}