<?php

namespace App\Http\Controllers\Application\Nodes;

use App\Http\Controllers\ApplicationApiController;
use App\Http\Controllers\Controller;
use App\Models\Node;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class NodeController extends ApplicationApiController
{
    public function index(Request $request)
    {
        $nodes = QueryBuilder::for(Node::query())
            ->allowedFilters(['main', 'cluster', 'hostname', 'port', 'auth_type'])
            ->allowedSorts(['id', 'port'])
            ->paginate($request->query('per_page') ?? 50);

        return $nodes;
    }

    public function show(Node $node)
    {
        return $this->returnContent([
            'data' => $node,
        ]);
    }
}