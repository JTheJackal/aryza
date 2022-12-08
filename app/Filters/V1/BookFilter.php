<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class BookFilter extends ApiFilter {

    protected $permittedParams = [

        'isbn' => ['eq', 'like', 'noteq'],
        'title' => ['eq', 'like', 'noteq'],
        'author' => ['eq', 'like', 'noteq'],
        'category' => ['eq', 'like', 'noteq'],
        'price' => ['eq', 'lt', 'gt', 'gteq', 'lteq', 'noteq']
    ];

    protected $columnMap = [

    ];

    public function transform(Request $request) {

        $eloQuery = [];

        // Iterate over permitted parameters
        foreach($this->permittedParams as $param => $operators) {

            $query = $request->query($param);

            if(!isset($query)) {

                continue;
            }

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