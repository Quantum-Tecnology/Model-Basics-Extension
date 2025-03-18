<?php

namespace QuantumTecnology\ModelBasicsExtension\Traits;

use Illuminate\Support\Collection;

trait Filter
{
    protected function filtered(
        string|array|Collection $params,
        ?string $filter = null,
        string $nameParam = 'filter',
        bool $allowFilter = true,
        bool $ignoreParams = false,
        bool $isBoolean = false,
    ): Collection|bool {
        $collect = match (true) {
            is_string($params)            => $params = collect(explode(',', $params)),
            $params instanceof Collection => $params,
            default                       => $params = collect($params),
        };

        if ($ignoreParams) {
            unset($collect);
            $collect = collect();
        }

        if ($allowFilter && !is_null($filter) && (request()->$nameParam[$filter] ?? false)) {
            if ($isBoolean) {
                return 'true' === request()->$nameParam[$filter] ? true : false;
            }

            collect(explode(',', request()->$nameParam[$filter]))->each(function ($id) use (&$collect) {
                $collect[] = $id;
            });
        }

        return count($collect) > 0 ? $collect : false;
    }
}
