<?php namespace ColladAPI\Core\Authentikacio;

use ColladAPI\Security\Authentication\AuthenticationService;
use Illuminate\Support\Facades\Auth;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthentikacioController extends RestExtController {

    private $authentication;

    public function __construct(AuthenticationService $as)
    {
        parent::__construct();
        $this->authentication = $as;
    }

    /**
     * Belepes
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function login()
    {

        if ($this->request->getContentType() !== 'json')
            $this->authentication->authenticateBasic();

        if (!Auth::attempt(array('email' => $this->request->json('email'), 'password' => $this->request->json('password'))))
            throw new HttpException(HttpStatus::UNAUTHORIZED);

        return $this->restResponse->plainResponse('Sikeresen belépett!', HttpStatus::OK);
    }

    /**
     * Kilepes
     */
    public function logout()
    {
        Auth::logout();
    }

}