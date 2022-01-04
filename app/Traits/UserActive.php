<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait UserActive
{
    /**
     * Scope a query to only include active users.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('active', true);
    }

    /**
     * Determine whether User is active
     *
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->active;
    }
}
