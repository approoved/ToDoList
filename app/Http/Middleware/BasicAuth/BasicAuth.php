<?php

namespace App\Http\Middleware\BasicAuth;

use Closure;
use RuntimeException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Container\BindingResolutionException;

abstract class BasicAuth
{
    protected string $username;
    
    protected string $password;

    abstract protected function getConfigPath(): string;

    public function __construct()
    {
        $config = config($this->getConfigPath());

        if (! isset($config['username']) || ! isset($config['password'])) {
            throw new RuntimeException(
                'Invalid Basic Auth configuration. Class - ' . static::class
            );
        }

        $this->username = $config['username'];
        $this->password = $config['password'];
    }

    /**
     * @throws BindingResolutionException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $username = $request->header('PHP_AUTH_USER');
        $password = $request->header('PHP_AUTH_PW');

        if ($username !== $this->username || $password !== $this->password) {
            return response()->make(
                'Invalid credentials.',
                Response::HTTP_UNAUTHORIZED,
                ['WWW-Authenticate' => 'Basic'] 
            );
        };
        
        return $next($request);
    }
}
