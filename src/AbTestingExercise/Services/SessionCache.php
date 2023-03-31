<?php

declare(strict_types=1);

namespace AbTestingExercise\Services;

use AbTestingExercise\Interfaces\CacheInterface;

/**
 * Class SessionCache
 * 
 * Responsible for caching data in the session so we can use it to show the same design to the user
 * 
 */
class SessionCache implements CacheInterface
{
    private $enabled = true;

    /**
     * SessionCache constructor.
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * @param  string  $key
     * @param $value
     */
    public function set(string $key, $value): void
    {
        if (! $this->enabled) {
            return;
        }

        $_SESSION[$key] = $value;
    }

    /**
     * @param  string  $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->enabled ? $_SESSION[$key] : null;
    }

    /**
     * @param  string  $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return $this->enabled ? isset($_SESSION[$key]) : false;
    }

    /**
     * Disable the cache
     */
    public function disable(): void
    {
        $this->enabled = false;
    }

    /**
     * Check if the cache is enabled
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }
}
