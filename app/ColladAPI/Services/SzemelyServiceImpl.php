<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/27/13
 * Time: 1:17 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Entities\Szemely;
use ColladAPI\Repositories\SzemelyRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use ColladAPI\Exceptions\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SzemelyServiceImpl implements SzemelyService {

    protected $szemelyRepository;
    protected $mailService;

    public function __construct(SzemelyRepository $szemelyRepository, MailService $mailService)
    {
        $this->szemelyRepository = $szemelyRepository;
        $this->mailService = $mailService;
    }

    public function findById($id)
    {
        return $this->szemelyRepository->findById($id);
    }

    /**
     * @param array $userData
     * @return bool|Szemely
     * @throws \ColladAPI\Exceptions\ErrorMessageException
     */
    public function register(array $userData)
    {
        $szemely = new Szemely();
        $szemely->fill($userData);
        $szemely->validate();

        if (!$szemely->save()) {
            throw new ErrorMessageException('Személy mentése közben hiba lépett fel');
            return false;
        }

        $this->mailService->sendRegistered($szemely);
        return $szemely;
    }

    /**
     * @param $id
     * @param array $userData
     * @return bool
     * @throws ValidationException
     */
    public function update($id, array $userData)
    {
        $szemely = $this->szemelyRepository->findById($id);
        $szemely->fill($userData);

        $szemely->validate();

        if (!$szemely->save()) {
            throw new ValidationException('Megadott felhasználói adatok között voltak hibásak');
            return false;
        }

        return $szemely;
    }

    public function delete($id)
    {
        $this->szemelyRepository->delete($id);
    }

    public function all()
    {
        return $this->szemelyRepository->all();
    }

    /**
     * @param $id
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findByIdWithDijak($id)
    {
        return $this->szemelyRepository->findByIdWithDijak($id);
    }
}