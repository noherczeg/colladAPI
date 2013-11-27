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


class EloquentSzemelyRepository extends EloquentCRUDRepository implements SzemelyRepository {

    public function __construct(Szemely $szemely)
    {
        $this->entity = $szemely;
    }

    public function all()
    {
        return $this->restCollection($this->entity);
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
        return $this->entity->where('api_kulcs', '=', $key)->firstOrFail();
    }

    /**
     * @param $email
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findByEmail($email)
    {
        return $this->entity->where('email', '=', $email)->firstOrFail();
    }

    /**
     * @param $id
     * @throws ModelNotFoundException
     * @return \Illuminate\Database\Eloquent\Collection|static
     */
    public function findByIdWithDijak($id)
    {
        return $this->entity->with('dijak')->where('id', '=', $id)->firstOrFail();
    }

    /**
     * Az adott azonositoju szemelyt keresi ki az osszes hozzatartozo adataval
     *
     * @param $id       Szemely Id
     * @return mixed    Szemely
     */
    public function findByIdWithAll($id)
    {
        return $this->entity->withAll()->where('id', '=', $id)->firstOrFail();
    }

    /**
     * Kikeresi az osszes tanart es egyeb adataikat, akik az adott idopontban tanszeken dolgoztak/nak
     *
     * @param \DateTime $atTime
     * @return array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function findTanarokAtTime(\DateTime $atTime)
    {
        $res = $this->entity->join('szemely_has_tanszek', 'szemely.id', '=', 'szemely_has_tanszek.szemely_id')
            ->where('kezdo_datum', '<=', $atTime->format('Y-m-d'))->where(function($query) use ($atTime) {
                $query->where('vege_datum', '>=', $atTime->format('Y-m-d'))->orWhere('vege_datum', '=', null);
            });

        return $this->restCollection($res);
    }

    /**
     * Kikeresi az osszes hallgatot es egyeb adataikat, akik az adott idopontban aktiv szakkal rendelkeztek/nek
     *
     * @param \DateTime $atTime
     * @return array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function findHallgatokAtTime(\DateTime $atTime)
    {
        $res = $this->entity->join('szemely_has_szak', 'szemely.id', '=', 'szemely_has_szak.szemely_id')
            ->where('kezdo_datum', '<=', $atTime->format('Y-m-d'))->where(function($query) use ($atTime) {
                $query->where('vege_datum', '>=', $atTime->format('Y-m-d'))->orWhere('vege_datum', '=', null);
            });

        return $this->restCollection($res);
    }

    /**
     * Osszes tanar es egyeb infoik az adott idopontok kozott
     *
     * @param \DateTime $fromTime
     * @param \DateTime $toTime
     * @return array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function findTanarokBetweenTimes(\DateTime $fromTime, \DateTime $toTime)
    {
        return $this->restCollection($this->entity->tanar()->withAll()->tanarHallgatoBetween($fromTime, $toTime));
    }

    /**
     * Osszes hallgato es egyeb infoik az adott idopontok kozott
     *
     * @param \DateTime $fromTime
     * @param \DateTime $toTime
     * @return array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function findHallgatokBetweenTimes(\DateTime $fromTime, \DateTime $toTime)
    {
        return $this->restCollection($this->entity->hallgato()->withAll()->tanarHallgatoBetween($fromTime, $toTime));
    }

    /**
     * A Szemelyhez tartozo osszes Fokozat kilistazasa
     *
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function fokozatokForSzemely($id)
    {
        return $this->restCollection($this->entity->with('fokozatok')->where('id', '=', $id));
    }

    /**
     * A Szemelyhez tartozo osszes Tanszeket kilistazza
     *
     * @param $id
     * @return array|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]
     */
    public function tanszekekForSzemely($id)
    {
        return $this->restCollection($this->entity->with('tanszekek')->where('id', '=', $id));
    }
}