<?php

namespace QuantumTecnology\ModelBasicsExtension\Traits;

trait SetSchemaTrait
{
    /**
     * Initialize the Set Schema trait for an instance.
     *
     * @return void
     */
    public function initializeSetSchemaTrait()
    {
        $this->setSchema();
    }

    public function setSchema()
    {
        $namespace = collect(explode('\\', static::class));
        $namespace->pop();

        $this->setTable(strtolower($namespace->last()) . '.' . $this->getTable());
    }
}
