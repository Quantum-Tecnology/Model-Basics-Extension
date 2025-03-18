<?php

declare(strict_types=1);

namespace QuantumTecnology\ModelBasicsExtension\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait ActionTrait
{
    public function actions(): Attribute
    {
        return Attribute::get(fn () => (object) ($this->setActions() + [
            'can_update' => true,
            'can_delete' => true,
        ]));
    }

    protected function setActions(): array
    {
        return [];
    }
}
