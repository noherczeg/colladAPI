<?php namespace ColladAPI\Security\Authentication;

use ColladAPI\Core\Szemely\SzemelyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Noherczeg\RestExt\Exceptions\ErrorMessageException;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\RestResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Authentikacioert felelos osztaly.
 *
 * Class        AuthenticationService
 * @package     ColladAPI\Security\Authentication
 * @category    Authentication
 * @author      Original Author <noherczeg@gmail.com>
 */

class AuthenticationService {

    /** @var \ColladAPI\Core\Szemely\SzemelyRepository Szemely Repo */
    private $szemelyek;

    /** @var \Illuminate\Http\Request Laraveles Request */
    private $request;

    /** @var \Noherczeg\RestExt\RestResponse Rest Response packagebol */
    private $restResponse;

    public function __construct(SzemelyRepository $repo, Request $request, RestResponse $resp)
    {
        $this->szemelyek = $repo;
        $this->request = $request;
        $this->restResponse = $resp;
    }

    /**
     * Basic Authentikacio.
     *
     * Kiveszi az authentikalo user adatai kozul a nevet egyedul (jelenleg api kulcs, nem is az email, vagy rendes nev!)
     * majd elvegzi a dolgat.
     *
     * A valos, de sikertelen probalkozasokat logoljuk.
     *
     * @throws ErrorMessageException
     * @return Response|void
     */
    public function authenticateBasic()
    {
        // nincs adat/nem megfelelo
        if (!$this->request->getUser())
            throw new ErrorMessageException('Hibas keres, hianyzo adatok?', HttpStatus::BAD_REQUEST);

        $user = $this->szemelyek->findByAPIKey($this->request->getUser());

        Auth::login($user);

        // sikertelen authentikacio
        if (!Auth::check()) {
            Log::info('Sikertelen belépési kísérlet', array('name' => $this->request->getUser(), 'ip' => $this->request->getClientIps()));
            throw new ErrorMessageException('Sikertelen belépési kísérlet', HttpStatus::UNAUTHORIZED);
        }
    }

} 