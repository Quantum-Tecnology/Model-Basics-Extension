<?php

declare(strict_types=1);

namespace QuantumTecnology\ModelBasicsExtension\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Response;

trait ActionTrait
{
    public static function bootActionTrait(): void
    {
        parent::updating(function ($model) {
            abort_unless(
                $model->actions?->can_update,
                Response::HTTP_FORBIDDEN,
                __('It is not possible to update.')
            );
        });

        parent::deleting(function ($model) {
            abort_unless(
                $model->action?->can_delete,
                Response::HTTP_FORBIDDEN,
                __('It is not possible to delete.')
            );
        });
    }

    public function actions(): Attribute
    {
        return Attribute::get(fn () => (object) $this->setActions());
    }

    protected function setActions(): array
    {
        return [];
    }
}
