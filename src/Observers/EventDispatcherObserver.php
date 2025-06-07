<?php

declare(strict_types = 1);

namespace QuantumTecnology\ModelBasicsExtension\Observers;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class EventDispatcherObserver
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
        $events = app(new ReflectionClass($model)->getName())?->events ?? [];

        foreach ($events as $event) {
            if (!class_exists($event)) {
                continue;
            }

            event(new $event($model));
        }
    }
}
