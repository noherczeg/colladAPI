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

class EloquentSzemelyRepository implements SzemelyRepository {

    private $szemely;

    public function __construct(Szemely $szemely)
    {
        $this->szemely = $szemely;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static
     */
    public function all()
    {
        return $this->szemely->with('szakok', 'szakok.kepzesszint', 'dijak')->get();
    }

    /**
     * @param $szemelyId
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findById($szemelyId)
    {
        return $this->szemely->with(
            'szakok', 'szakok.kepzesszint', 'dijak', 'alkotasok', 'esemenyek', 'nyelvtudasok', 'fokozatok',
            'intezmenyek', 'szervezetek', 'tanszekek', 'publikaciok', 'csoportok', 'tanulmanyutak', 'palyazatok'
        )->where('id', '=', $szemelyId)->firstOrFail();
    }

    /**
     * @param Szemely $szemely
     * @return bool|null
     */
    public function saveOrUpdate(Szemely $szemely)
    {
        return $szemely->save();
    }

    /**
     * @param $entityId
     * @return bool|null
     */
    public function delete($entityId)
    {
        return $this->szemely->destroy($entityId);
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