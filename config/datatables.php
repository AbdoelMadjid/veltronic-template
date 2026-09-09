<?php

use Yajra\DataTables\ApiResourceDataTable;
use Yajra\DataTables\CollectionDataTable;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\PaginatorDataTable;
use Yajra\DataTables\QueryDataTable;

return [
    /*
     * DataTables search options.
     */
    'search' => [
        'smart' => true,
        'multi_term' => true,
        'case_insensitive' => true,
        'use_wildcards' => false,
        'starts_with' => false,
    ],

    /*
     * DataTables internal index id response column name.
     */
    'index_column' => 'DT_RowIndex',

    /*
     * Maximum number of records that can be requested per page.
     */
    'max_length' => null,

    /*
     * List of available builders for DataTables.
     */
    'engines' => [
        'eloquent' => EloquentDataTable::class,
        'query' => QueryDataTable::class,
        'collection' => CollectionDataTable::class,
        'paginator' => PaginatorDataTable::class,
        'resource' => ApiResourceDataTable::class,
    ],

    /*
     * DataTables accepted builder to engine mapping.
     */
    'builders' => [
        // Illuminate\Database\Eloquent\Relations\Relation::class => 'eloquent',
        // Illuminate\Database\Eloquent\Builder::class            => 'eloquent',
        // Illuminate\Database\Query\Builder::class               => 'query',
        // Illuminate\Support\Collection::class                   => 'collection',
        // Illuminate\Pagination\LengthAwarePaginator::class      => 'paginator',
    ],

    'nulls_last_sql' => ':column :direction NULLS LAST',

    'error' => env('DATATABLES_ERROR', null),

    'columns' => [
        'excess' => ['rn', 'row_num'],
        'escape' => '*',
        'raw' => ['action'],
        'blacklist' => ['password', 'remember_token'],
        'whitelist' => '*',
    ],

    'json' => [
        'header' => [],
        'options' => 0,
    ],

    'callback' => ['$', '$.', 'function'],
];
