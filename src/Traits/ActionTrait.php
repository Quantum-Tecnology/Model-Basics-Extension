<?php

declare(strict_types=1);

namespace QuantumTecnology\ModelBasicsExtension\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ActionTrait
{
    public static function bootActionTrait(): void
    {
        parent::updating(function ($model) {
            abort_unless(
                $model->actions->can_update,
                403,
                __('It is not possible to update.')
            );
        });

        parent::deleting(function ($model) {
            abort_unless(
                $model->actions->can_delete,
                403,
                __('It is not possible to delete')
            );
        });
    }

    public function actions(): Attribute
    {
        return Attribute::get(fn () => collect($this->setActions() + [
            'can_update' => true,
            'can_delete' => true,
        ]));
    }

    protected function setActions(): array
    {
        return [];
    }
}
