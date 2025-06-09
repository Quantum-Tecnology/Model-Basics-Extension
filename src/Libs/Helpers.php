<?php

declare(strict_types = 1);

/*
 * Helpers.
 */

if (!function_exists('rememberCustomCache')) {
    function rememberCustomCache(
        string $key,
        callable $callable,
        array $filters = [],
        int $time = 60 * 60 * 24,
        string $customName = 'custom_cache',
        string $separator = ':',
    ): int {

        if(function_exists('request') && request()->has('filter')) {
            $filters = array_merge(
                $filters,
                request('filter', [])
            );
        }
        /*
         * If the key already exists, return it.
         */
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
        $customCacheName = $key . $separator . implode($separator, $filters);

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

if(!function_exists('deleteCustomCache')) {
    function deleteCustomCache(
        string $key,
        string $customName = 'custom_cache',
        string $separator = ':',
    ): void {
        $key = sprintf(
            '%s%s%s',
            $customName,
            $separator,
            $key
        );

        $keys = cache()->get($key, []);

        collect($keys)
            ->each(function ($item) {
                cache()->delete($item);
            });

        cache()->delete($key);
    }
}