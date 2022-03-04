<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;

class Sort
{
    private $schemaTable;

    public function __construct($schemaTable)
    {
        $this->schemaTable = $schemaTable;
    }

    public function handle(Builder $query, Closure $next)
    {
        $sort = (!empty(request()->desc) && request()->desc == 'true') ? 'desc' : 'asc';

        if (!empty(request()->sortBy) && Schema::hasColumn($this->schemaTable,  request()->sortBy)) {
            $query->orderBy(request()->sortBy, $sort);
        } else if (!empty(request()->desc)) {

            $query->orderBy('created_at', $sort);
        }

        return $next($query);
    }
}
