<?php

namespace App\Services\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

trait CanSendGetRequest
{
    public function get(
        PendingRequest $request,
        string $url,
        array $query
    ): Response
    {
        return $request->get(
            url: $url,
            query: $query,
        );
    }
}
