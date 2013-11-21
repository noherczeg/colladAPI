<?php
/**
 * Created by Norbert Csaba Herczeg.
 * Date: 9/27/13
 * Time: 1:17 AM
 */

namespace ColladAPI\Services;

use ColladAPI\Auth\AuthorizationInterface;
use ColladAPI\Entities\Szemely;
use ColladAPI\Repositories\SzemelyRepository;
use ColladAPI\Exceptions\ErrorMessageException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class SzemelyServiceImpl extends CRUDServiceImpl implements SzemelyService {

    protected $mailService;

    public function __construct(SzemelyRepository $szemelyRepository, MailService $mailService)
    {
        $this->repository = $szemelyRepository;
        $this->mailService = $mailService;
    }

    /**
     * @param array $entityData
     * @return bool|Szemely
     * @throws \ColladAPI\Exceptions\ErrorMessageException
     */
    public function register(array $entityData)
    {
        $szemely = new Szemely();
        $szemely->fill($entityData);
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
     * @throws ModelNotFoundException
     * @return Szemely
     */
    public function findByIdWithDijak($id)
    {
        return $this->repository->findByIdWithDijak($id);
    }
}