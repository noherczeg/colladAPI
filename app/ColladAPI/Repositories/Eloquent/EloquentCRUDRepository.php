<?php


namespace ColladAPI\Repositories\Eloquent;

use ColladAPI\Entities\ColladEntity;
use ColladAPI\Exceptions\NotFoundException;
use ColladAPI\Repositories\CRUDRepository;
use Illuminate\Support\Facades\Config;

class EloquentCRUDRepository implements CRUDRepository
{

    protected $pagination = false;

    /** @var ColladEntity vagy annak leszarmazottja mellyel dolgozunk */
    protected $entity;

    /** @var  Csoportok hozzaferese, only, except alatt */
    protected $groups = [
        'only' => [],
        'except' => []
    ];

    /** @var  Jogosultsag alau hozzaferes, only, except alatt, prioritasa van a csoportok felett */
    protected $permissions = [
        'only' => [],
        'except' => []
    ];

    public function __construct(ColladEntity $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static
     */
    public function all()
    {
        return $this->entity->get();
    }

    /**
     * Kivalasztja az azonositohoz tartozo Entitast
     *
     * @param $entityId
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|static
     */
    public function findById($entityId)
    {
        return $this->entity->findOrFail($entityId);
    }

    /**
     * Torli az azonositohoz tartozo entitast
     *
     * @param $entityId
     * @return bool|null
     */
    public function delete($entityId)
    {
        $this->entity = ColladEntity::findOrFail($entityId);
        return $this->entity->delete();
    }

    /**
     * Ment egy Entitast a megadott adatok felhasznalasaval
     *
     * @param array $entity
     * @return bool
     */
    public function save(array $entity)
    {
        $this->entity->fill($entity);
        $this->entity->validate();
        return $this->entity->save();
    }

    /**
     * Frissiti a kapott adatok alapjan az adatokhoz tartozo Entitast
     *
     * @param array $entity
     * @return bool
     */
    public function update(array $entity)
    {
        $this->entity = ColladEntity::findOrFail($entity['id']);

        foreach ($entity as $key => $val) {
            $this->entity->$key = $val;
        }

        $this->entity->validate();
        return $this->entity->save();
    }

    /**
     * Bekapcsolja/allitja a lapozast/annak mennyiseget per oldal
     *
     * @param bool|int $boolValue
     */
    public function enablePagination($boolValue)
    {
        $this->pagination = $boolValue;
    }

    /**
     * Visszater vagy lapozhato, vagy normal Collectionnel. Amennyiben nem
     *
     * @param \Illuminate\Database\Eloquent\Builder $entity
     * @return array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\Paginator|static[]|\Illuminate\Database\Eloquent\Builder
     * @throws NotFoundException
     */
    public function restCollection($entity)
    {
        $collection = [];

        if ($this->pagination == false) {
            $collection = $entity->get();
        } else {
            $collection = $entity->paginate($this->pagination);
        }

        /*if (count($collection) == 0 && Config::get('rest.out_of_bounds_exception'))
            throw new NotFoundException;*/

        return $collection;
    }
}