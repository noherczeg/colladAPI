<?php namespace ColladAPI\Core\Publikacio;

use Illuminate\Database\Eloquent\Builder;
use Noherczeg\RestExt\Entities\ResourceEloquentEntity;
use Noherczeg\RestExt\Entities\ResourceEntity;

class Publikacio extends ResourceEloquentEntity implements ResourceEntity {

    protected $table = "publikacio";

    protected $rootRelName = 'publikaciok';

    protected $hidden = ['created_at'];

    protected $fillable = [
        'tipus_id', 'nyelv_id', 'cim', 'datum', 'lektoralt', 'megjelenes_hely', 'megjelenes_kiado', 'oldalszam',
        'kotet', 'impaktfaktor', 'hivatkozas_fuggetlen', 'hivatkozas_fuggo', 'mtmt_id', 'megjegyzes'
    ];

    protected $rules = [
        'cim' => 'required|alpha_num|between:2,256',
        'datum' => 'required|date',
        'lektoralt' => 'required|integer',
        'megjelenes_hely' => 'max:256',
        'megjelenes_kiado' => 'max:256',
        'oldalszam' => 'integer',
        'kotet' => 'max:256',
        'impaktfaktor' => 'numeric',
        'hivatkozas_fuggetlen' => 'integer',
        'hivatkozas_fuggo' => 'integer',
        'mtmt_id' => 'max:64',
        'megjegyzes' => 'max:512',
        'tipus_id' => 'required',
        'nyelv_id' => 'required',
    ];

    public function palyazatok() {
        return $this->belongsToMany('ColladAPI\\Core\\Palyazat\\Palyazat', 'palyazat_has_publikacio', 'publikacio_id', 'palyazat_id');
    }

    public function nyelv() {
        return $this->belongsTo('ColladAPI\\Core\\Nyelv\\Nyelv');
    }

    public function tipus() {
        return $this->belongsTo('ColladAPI\\Core\\Publikacio\\PublikacioTipus');
    }

    public function szemelyek() {
        return $this->belongsToMany('ColladAPI\\Core\\Szemely\\Szemely', 'publikacio_has_szemely', 'publikacio_id', 'szemely_id');
    }

    /**
     * Scope metodus az entitas osszes relaciojanak "felcsatolasara"
     *
     * @param $query
     * @return Builder
     */
    public function scopeWithAll($query)
    {
        return $query->with('palyazatok', 'nyelv', 'tipus');
    }

    /**
     * Resource reprezentacio eseten bool erteket adunk vissza nem intet
     *
     * @return bool
     */
    public function getHivatkozasFuggetlenAttribute()
    {
        return ($this->attributes['hivatkozas_fuggetlen'] === 1) ? true : false;
    }

    /**
     * Boolean erteket konvertal int-be, perzisztenciahoz
     *
     * @param bool $value
     */
    public function setHivatkozasFuggetlenAttribute($value)
    {
        $this->attributes['hivatkozas_fuggetlen'] = ($value === true) ? 1 : 0;
    }

    /**
     * Resource reprezentacio eseten bool erteket adunk vissza nem intet
     *
     * @return bool
     */
    public function getLektoraltAttribute()
    {
        return ($this->attributes['lektoralt'] === 1) ? true : false;
    }

    /**
     * Boolean erteket konvertal int-be, perzisztenciahoz
     *
     * @param bool $value
     */
    public function setLektoraltAttribute($value)
    {
        $this->attributes['lektoralt'] = ($value === true) ? 1 : 0;
    }

}