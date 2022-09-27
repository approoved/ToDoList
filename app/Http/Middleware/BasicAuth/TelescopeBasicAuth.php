<?php

namespace App\Http\Middleware\BasicAuth;

final class TelescopeBasicAuth extends BasicAuth
{
    protected function getConfigPath(): string
    {
        return 'telescope.basic_auth';
    }
}
