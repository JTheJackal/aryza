<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {

    protected $permittedParams = [];

    protected $columnMap = [];

    protected $operatorMap = [

        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'gteq' => '>=',
        'lteq' => '<=',
        'noteq' => '!='
    ];

    public function transform(Request $request) {

        $eloQuery = [];

        // Iterate over permitted parameters
        foreach($this->permittedParams as $param => $operators) {

            // Grab the query that came in
            $query = $request->query($param);

            // If no query exists, skip
            if(!isset($query)) {

                continue;
            }

            // Set the column we're filtering by
            $column = $this->columnMap[$param] ?? $param;
            
            
            foreach($operators as $operator) {
                if(isset($query[$operator])) {

                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}