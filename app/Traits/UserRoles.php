<?php

namespace App\Traits;

use App\Interfaces\UserRole;
use App\Services\UserRoleService;
use Illuminate\Support\Str;
use JetBrains\PhpStorm\Pure;

/**
 * User roles with limitations...
 * Roles are hardcoded in App\Interfaces\UserRoleInterface
 * so User may have only one Role.
 * Just that simple, just so stupid.
 * Without many-to-many relations.
 * Because it is not necessary for this project.
 * I am consciously doing such a bad practice.
 */
trait UserRoles
{
    /**
     * Check user's UserRole: Admin or Not
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->role === UserRole::ADMIN;
    }

    /**
     * Check user's UserRole: Assistant or Not
     *
     * @return boolean
     */
    public function isOwner(): bool
    {
        return $this->role === UserRole::OWNER;
    }

    /**
     * Determine whether user is has Teacher UserRole
     *
     * @return boolean
     */
    public function isTeacher(): bool
    {
        return $this->role === UserRole::TEACHER;
    }

    /**
     * Determine whether user is has Teacher UserRole
     *
     * @return boolean
     */
    public function isInstructor(): bool
    {
        return $this->role === UserRole::INSTRUCTOR;
    }

    /**
     * Determine whether user is has STUDENT UserRole
     *
     * @return boolean
     */
    public function isStudent(): bool
    {
        return $this->role === UserRole::STUDENT;
    }

    /**
     * Determine whether user is has ENROLLEE UserRole
     *
     * @return boolean
     */
    public function isEnrollee(): bool
    {
        return $this->role === UserRole::ENROLLEE;
    }

    /**
     * Determine whether user is has GRADUATED UserRole
     *
     * @return boolean
     */
    public function isGraduated(): bool
    {
        return $this->role === UserRole::GRADUATED;
    }

    /**
     * Same as isClient() TODO: remove one
     *
     * @return bool
     */
    #[Pure]
    public function mayHavePerson(): bool
    {
        return $this->isEnrollee() ||
            $this->isStudent() ||
            $this->isGraduated();
    }

    /**
     * @return bool
     */
    #[Pure]
    public function isClient(): bool
    {
        return $this->isEnrollee() ||
            $this->isStudent() ||
            $this->isGraduated();
    }

    /**
     * Determine whether user has given role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        $role = Str::upper($role);

        return $this->getRoleName() === $role;
    }

    /**
     * Returns user's role name
     *
     * @return string
     */
    public function getRoleName(): string
    {
        return UserRoleService::getNameByValue($this->role);
    }
}
