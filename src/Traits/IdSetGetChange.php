<?php

declare(strict_types = 1);

namespace GustavoSantarosa\ModelBasicsExtension\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;

trait IdSetGetChange
{
    protected function id(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->attributes[$this->getKeyName()],
            set: fn ($value) => $this->attributes[$this->getKeyName()] = $value,
        );
    }
}
