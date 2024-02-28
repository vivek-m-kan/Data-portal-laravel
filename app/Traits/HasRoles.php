<?php

namespace App\Traits;

use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait HasRoles
{
    /**
     * Detemine if the user has the desired role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        $providedRole = Str::lower(Str::replace(" ", "-", $role));

        $rolesArr = $this->roles()->pluck('role')->all();

        $mappedRoles = Arr::map($rolesArr, fn (string $value) => Str::lower(Str::replace(" ", "-", $value)));

        return in_array($providedRole, $mappedRoles);
    }

    /**
     * Get the role ids via role names
     *
     * @param array $roles
     * @return array
     */
    protected function getRoleIds(array $roles): array
    {
        $mappedRoles = Arr::map($roles, fn (string $value) => Str::lower(Str::replace(" ", "-", $value)));

        $roleIdsArr = Roles::whereIn('role', $mappedRoles)->pluck('uuid')->all();

        return $roleIdsArr;
    }

    /**
     * Get the role differentiated ids via role names
     *
     * @param array $roles
     * @return array
     */
    protected function getDifferentiatedRolesIds(array $roles): array
    {
        $mappedRoles = Arr::map($roles, fn (string $value) => Str::lower(Str::replace(" ", "-", $value)));

        $roleIdsArr = Roles::whereIn('role', $mappedRoles)->pluck('uuid')->all();
        $assignedRoleIds = $this->roles()->pluck('uuid')->all();

        return array_diff($roleIdsArr, $assignedRoleIds);
    }

    /**
     * Assign a desired role(s) to provied user
     *
     * @param array|string $role
     * @return $this
     */
    public function assignRoles(array|string $role): User
    {
        $roles = is_string($role) ? [$role] : $role;

        $roleIds = $this->getDifferentiatedRolesIds($roles);

        if (!empty($roleIds)) {
            $this->roles()->attach($roleIds);
        }

        return $this;
    }
}
