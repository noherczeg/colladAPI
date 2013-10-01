<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 10/1/13
 * Time: 10:36 PM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Palyazat;
use ColladAPI\Exceptions\ValidationException;
use ColladAPI\Repositories\PalyazatRepository;
use ColladAPI\Services\PalyazatService;

class PalyazatServiceImpl implements PalyazatService {

    protected $palyazatRepository;

    public function __construct(PalyazatRepository $palyazatRepository)
    {
        $this->palyazatRepository = $palyazatRepository;
    }

    public function findById($id)
    {
        return $this->palyazatRepository->findById($id);
    }

    /**
     * @param $id
     * @param array $palyazatData
     * @return bool|Palyazat
     * @throws ValidationException
     */
    public function update($id, array $palyazatData)
    {
        $palyazat = $this->palyazatRepository->findById($id);
        $palyazat->fil($palyazatData);
        $palyazat->validate();

        if (!$palyazat->save()) {
            throw new ValidationException('Megadott pályázat adatok között voltak hibásak');
            return false;
        }

        return $palyazat;
    }

    public function delete($id)
    {
        $this->palyazatRepository->delete($id);
    }

    public function all()
    {
        return $this->palyazatRepository->all();
    }

    /**
     * @param array $palyazatData
     * @return bool|Palyazat
     * @throws ValidationException
     */
    public function save(array $palyazatData)
    {
        $palyazat = new Palyazat();
        $palyazat->fill($palyazatData);
        $palyazat->validate();

        if (!$palyazat->save()) {
            throw new ValidationException('Megadott pályázat adatok között voltak hibásak');
            return false;
        }

        return $palyazat;
    }
}