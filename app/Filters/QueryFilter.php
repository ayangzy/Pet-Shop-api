<?php

namespace App\Filters;

use Illuminate\Pipeline\Pipeline;

class QueryFilter
{
    private $schemaTable;
    private $schemaClass;

    /**
     * @param mixed $schemaTable
     * @param mixed $schemaClass
     * The schema table is the table through which you want to filter
     * the schema class the is class instance of the same table as above
     */
    public function __construct($schemaClass, $schemaTable)
    {
        $this->schemaTable = $schemaTable;
        $this->schemaClass = $schemaClass;
    }

    public function filter(): object
    {
        $filters = app(Pipeline::class)
            ->send($this->schemaClass::query())
            ->through([
                new Sort($this->schemaTable),
                AuthUserFilter::class,
            ])
            ->thenReturn()
            ->get();

        return $filters;
    }
}
