<?php

/*
 * This file is part of Dinkbit Filterable.
 *
 * (c) Joseph Cohen <joseph.cohen@dinkbit.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Dinkbit\Filterable;

/**
 * This is the filterable trait.
 *
 * @author Joseph Cohen <joseph.cohen@dinkbit.com>
 */
trait FilterableTrait
{
    /**
     * Add filter scopes dynamically.
     *
     * @param array $params
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, array $params)
    {
        foreach ($params as $key => $value) {
            if (! in_array($key, $this->getFilterableColumns()) || ! is_string($key) || is_null($value)) {
                continue;
            }

            $query->{$key}($value);
        }

        return $query;
    }

    /**
     * Get the filterable columns.
     *
     * @return array
     */
    public function getFilterableColumns()
    {
        return isset($this->filterable) ? $this->filterable : [];
    }
}
