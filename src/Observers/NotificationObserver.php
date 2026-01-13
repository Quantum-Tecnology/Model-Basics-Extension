<?php

namespace QuantumTecnology\ModelBasicsExtension\Observers;

use App\Events\ModelRestore;
use App\Events\ModelUpdated;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;
use Illuminate\Database\Eloquent\Model;
use QuantumTecnology\ValidateTrait\Data;

class NotificationObserver implements ShouldHandleEventsAfterCommit
{
    public function deleted(Model $model)
    {
        /*    event(new ModelUpdated(new Data([
               'model'   => $model,
               'message' => "A pessoa {$model->name} foi movida para a lixeira.",
           ]))); */
    }

    public function restored(Model $model)
    {
        /* event(new ModelRestore(new Data([
            'model'   => $model,
            'message' => "A pessoa {$model->name} foi restaurada.",
        ]))); */
    }
}
