<?php

namespace ColladAPI\Security\Authorization;


use Noherczeg\RestExt\Services\AuthorizationService;

class AuthServiceImpl implements AuthorizationService {

    private $roles = [];

    private $rolesFieldName = 'nev';

    public function __construct()
    {
        // get the roles for the current user
        $rolesTmp = \Auth::user()->with('roles')->where('id', \Auth::user()->id)->firstOrFail()->getRelation('roles')->toArray();

        foreach ($rolesTmp as $role) {
            $this->roles[] = $role[$this->rolesFieldName];
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
}