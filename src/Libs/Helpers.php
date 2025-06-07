<?php

declare(strict_types = 1);

/*
 * Helpers.
 */

if (!function_exists('rememberCustomCache')) {
    function rememberCustomCache(
        string $key,
        callable $callable,
        int $time = 60 * 60 * 24,
        bool $withFilter = false,
        string $customName = 'custom_cache',
        string $separator = ':',
    ): int {
        /*
         * If the key already exists, return it.
         */
        if ($withFilter && request()->has('filter')) {
            $key = sprintf(
                '%s%s%s',
                $customName,
                $separator,
                $key
            );

            /**
             * Retrieve existing keys from the cache.
             */
            $keys            = cache()->get($key, []);
            $customCacheName = $key . $separator . implode($separator, request('filter', []));

            if (!in_array($customCacheName, $keys, true)) {
                $keys[] = $customCacheName;

                cache()->put(
                    $key,
                    $keys,
                    $time
                );
            }

            return cache()->remember(
                $customCacheName,
                $time,
                $callable,
            );
        }

        return cache()->remember(
            $key,
            $time,
            $callable,
        );
    }
}