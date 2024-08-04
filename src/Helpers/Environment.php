<?php

namespace Covaleski\IntraPhp\Helpers;

/**
 * Provides helper methods to interact with the current environment.
 */
class Environment
{
    /**
     * Get an environment variable value.
     */
    public static function getValue(string $name): null|string
    {
        $value = getenv($name);
        return is_string($value) ? $value : null;
    }

    /**
     * Get all environment variables.
     * 
     * @throws \RuntimeException If fails to get the variables.
     */
    public static function getValues(): array
    {
        try {
            $value = getenv();
        } catch (\Throwable $throwable) {
            $value = false;
        }
        if (!is_array($value)) {
            $message = "Failed to get environment variables.";
            throw new \RuntimeException($message, 0, $throwable ?? null);
        }
        return $value;
    }

    /**
     * Set an environment variable value.
     * 
     * @throws \RuntimeException If fails to set the variable.
     */
    public static function setValue(string $name, string $value): void
    {
        try {
            $success = putenv("{$name}={$value}");
        } catch (\Throwable $throwable) {
            $success = false;
        }
        if (!$success) {
            $message = "Failed to set environment variable {$name}.";
            throw new \RuntimeException($message, 0, $throwable ?? null);
        }
    }
}
