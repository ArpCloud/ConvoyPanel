<?php

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use Convoy\Services\Nodes\ServerRateLimitsSyncService;

beforeEach(fn () => Http::preventStrayRequests());

it('can rate limit servers if over limit', function () {
    Http::fake([
        '*' => Http::response(['data' => 'dummy-upid'], 200),
    ]);

    [$_, $_, $node, $server] = createServerModel();

    $server->update([
        'bandwidth_usage' => 8192,
        'bandwidth_limit' => 4092,
    ]);

    app(ServerRateLimitsSyncService::class)->handle($node);

    Http::assertSent(function (Request $request) {
        return $request->method() === 'POST';
    });
});
