<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 11:32 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Tanszek;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Exceptions\ValidationException;
use ColladAPI\Repositories\TanszekRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TanszekServiceImpl implements TanszekService {

    private $tanszekRepository;

    public function __construct(TanszekRepository $tanszekRepository)
    {
        $this->tanszekRepository = $tanszekRepository;
    }

    public function findById($id)
    {
        return $this->tanszekRepository->findById($id);
    }

    public function update($id, array $userData)
    {
        $tanszek = $this->tanszekRepository->findById($id);
        $tanszek->fill($userData);
        $tanszek->validate();

        if (!$tanszek->save()) {
            throw new ValidationException('Megadott tanszék adatok között voltak hibásak');
            return false;
        }

        return $tanszek;
    }

    public function delete($id)
    {
        $this->tanszekRepository->delete($id);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static
     */
    public function all()
    {
        return $this->tanszekRepository->all();
    }

    public function save(array $tanszekData)
    {
        $tanszek = new Tanszek();
        $tanszek->fill($tanszekData);
        $tanszek->validate();

        if (!$tanszek->save()) {
            throw new ValidationException('Megadott tanszék adatok között voltak hibásak');
            return false;
        }

        return $tanszek;
    }

    public function szemelyekByDate($tanszekId, \DateTime $date)
    {
        return $this->tanszekRepository->szemelyekByDate($tanszekId, $date);
    }
}