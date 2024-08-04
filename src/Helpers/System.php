<?php

namespace Covaleski\IntraPhp\Helpers;

/**
 * Provides helper methods to interact with the OS.
 */
class System
{
    /**
     * Resolve an executable name to its disk location.
     */
    public static function findExecutable(string $name): string
    {
        $which = System::isWindows() ? 'where' : 'which';
        return trim((string) shell_exec("{$which} {$name}"));
    }

    /**
     * Get the current working directory.
     */
    public static function getCwd(): string
    {
        $directory = getcwd();
        if ($directory === false) {
            $message = 'Failed to get the current working directory.';
            throw new \RuntimeException($message);
        }
        return rtrim($directory, '\\/');
    }

    /**
     * Check whether PHP is running on a Windows install.
     */
    public static function isWindows(): bool
    {
        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
    }
}
