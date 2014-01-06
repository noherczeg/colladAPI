<?php namespace ColladAPI\Security\Authorization;

use Illuminate\Support\Facades\Auth;
use Noherczeg\RestExt\Providers\HttpStatus;
use Noherczeg\RestExt\Services\AuthorizationService;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AuthServiceImpl implements AuthorizationService {

    private $roles = [];

    private $rolesFieldName = 'nev';

    public function __construct()
    {
        // Check if there is a logged in user or not
        if($this->isLoggedIn()) {

            // get the roles for the current user
            $rolesTmp = Auth::user()->with('roles')->where('id', Auth::user()->id)->firstOrFail()->getRelation('roles')->toArray();

            foreach ($rolesTmp as $role) {
                $this->roles[] = $role[$this->rolesFieldName];
            }
        }
    }

    /**
     * Checks if the authenticated User has any of the given Roles (names) specified in the parameter array
     *
     * @param array $roles Array of strings
     * @return boolean
     */
    public function hasRoles(array $roles)
    {
        foreach ($roles as $role) {
            if (in_array($role, $this->roles))
                return true;
        }

        return false;
    }

    /**
     * Checks if the authenticated User has the given Role or not
     *
     * @param string $role
     * @return boolean
     */
    public function hasRole($role)
    {
        if (in_array($role, $this->roles))
            return true;
        return false;
    }

    /**
     * @return bool
     */
    private function isLoggedIn()
    {
        return Auth::check();
    }
}