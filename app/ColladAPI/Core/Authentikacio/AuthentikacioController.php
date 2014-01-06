<?php namespace ColladAPI\Core\Authentikacio;

use Illuminate\Auth\Guard;
use Illuminate\Support\Facades\App;
use Noherczeg\RestExt\Controllers\RestExtController;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Providers\MediaType;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthentikacioController extends RestExtController {

    /** @var Guard Authentikacio Service */
    private $auth;

    public function __construct()
    {
        $this->auth = App::make('guard');
    }

    /**
     * Belepes
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function login()
    {
        $this->consume([MediaType::APPLICATION_JSON]);

        if (!$this->auth->attempt(array('email' => $this->request->json('email'), 'password' => $this->request->json('password'))))
            throw new HttpException(HttpStatus::UNAUTHORIZED);

        return $this->restResponse->plainResponse(null, HttpStatus::OK);
    }

    /**
     * Kilepes
     */
    public function logout()
    {
        $this->auth->logout();
    }

}