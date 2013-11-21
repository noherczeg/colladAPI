<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/25/13
 * Time: 9:32 PM
 */

namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\Szemely;
use ColladAPI\Repositories\SzemelyRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use ColladAPI\Repositories\Eloquent\EloquentCRUDRepository;

class EloquentSzemelyRepository extends EloquentCRUDRepository implements SzemelyRepository {

    public function __construct(Szemely $szemely)
    {
        $this->entity = $szemely;
    }

    public function all()
    {
        $ent = $this->entity->with('szakok', 'tanszekek');
        return $this->restCollection($ent);
    }

    /**
     * @param $szemelyId
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findById($szemelyId)
    {
        return $this->entity->with(
            'szakok', 'szakok.kepzesszint', 'dijak', 'alkotasok', 'esemenyek', 'nyelvtudasok', 'fokozatok',
            'intezmenyek', 'szervezetek', 'tanszekek', 'publikaciok', 'tanulmanyutak', 'palyazatok'
        )->where('id', '=', $szemelyId)->firstOrFail();
    }

    /**
     * @param $key
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findByAPIKey($key)
    {
        return $this->szemely->where('api_kulcs', '=', $key)->firstOrFail();
    }

    /**
     * @param $email
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findByEmail($email)
    {
        return $this->szemely->where('email', '=', $email)->firstOrFail();
    }

    /**
     *
     * @param $id
     * @throws ModelNotFoundException
     * @return \Illuminate\Database\Eloquent\Collection|static
     */
    public function findByIdWithDijak($id)
    {
        return $this->szemely->with('dijak')->where('id', '=', $id)->firstOrFail();
    }
}