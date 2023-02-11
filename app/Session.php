<?php

namespace App;

use App\Contracts\SessionInterface;
use App\DataObjects\SessionConfig;
use App\Exception\SessionException;

class Session implements SessionInterface
{
    public function __construct(private readonly SessionConfig $options)
    {
    }

    public function start(): void
    {
        if ($this->isActive()) {
            throw new SessionException('Session has already been started');
        }

        if (headers_sent($fileName, $line)) {
            throw new SessionException("Headers already sent in file $fileName on line $line");
        }
        session_set_cookie_params(['secure' => $this->options->secure, 'httponly' => $this->options->httpOnly, 'samesite' => $this->options->sameSite->value]);
        if (!empty($this->options->name)) {
            session_name($this->options->name);
        }
        if (!session_start()) {
            throw new SessionException('Failed to start session');
        }
    }

    public function save(): void
    {
        session_write_close();
    }

    public function isActive(): bool
    {
        return session_status() === PHP_SESSION_ACTIVE;
    }

    public function get(string $key, mixed $default = null): mixed
    {
        return $this->has($key) ? $_SESSION[$key] : $default;
    }

    public function regenerate(): bool
    {
        return session_regenerate_id(true);
    }

    public function put(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function forget(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION);
    }
}