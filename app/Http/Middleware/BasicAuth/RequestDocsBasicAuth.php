<?php

namespace App\Http\Middleware\BasicAuth;

final class RequestDocsBasicAuth extends BasicAuth
{
    protected function getConfigPath(): string
    {
        return 'request-docs.basic_auth';
    }
}
