<?php

declare(strict_types = 1);

namespace QuantumTecnology\ModelBasicsExtension\Observers;

use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class CacheObserver implements ShouldHandleEventsAfterCommit
{
    public function deleted(Model $model): void
    {
        $this->handle($model);
    }

    public function restored(Model $model): void
    {
        $this->handle($model);
    }

    public function created(Model $model): void
    {
        $this->handle($model);
    }

    public function updated(Model $model): void
    {
        $this->handle($model);
    }

    private function handle(Model $model): void
    {
        $this->deleteCache(
            app(new ReflectionClass($model)->getName())?->caches ?? []
        );
    }

    protected function deleteCache(array $keys): void
    {
        foreach ($keys as $key) {
            if (enum_exists(get_class($key))) {
                $key = $key->value;
            }
            deleteCustomCache($key);
        }
    }
}
