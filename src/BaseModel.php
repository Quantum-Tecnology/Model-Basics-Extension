<?php

namespace QuantumTecnology\ModelBasicsExtension;

use Carbon\Carbon;
use QuantumTecnology\ModelBasicsExtension\Traits\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Model Base.
 *
 * @category Model
 */
class BaseModel extends Model
{
    use Filter;

    public static $allowedFields = [];

    /**
     * Por default no laravel não possui o sync para hasmany nas relações.
     * Entao ele foi modificado, para que ele retorne o syncable.
     *
     * @return HasManySyncable
     */
    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        $instance   = $this->newRelatedInstance($related);
        $foreignKey = $foreignKey ?: $this->getForeignKey();
        $localKey   = $localKey ?: $this->getKeyName();

        return new HasManySyncable(
            $instance->newQuery(),
            $this,
            $instance->getTable().'.'.$foreignKey,
            $localKey
        );
    }

    /**
     * Utilizado para quando o request vim com array com coluna repetida.
     * orWhere[][descricao].
     */
    public function arrayWhereOr(Builder $query, array $orWhere): Builder
    {
        foreach ($orWhere as $indice => $value) {
            if (is_array($value)) {
                $this->arrayWhereOr($query, $value);
            } else {
                $indice = 'cpfcnpj' == $indice ?
                    "translate({$indice}, '.,-/', '')" : $indice;
                $query->orWhereRaw(
                    "UPPER(unaccent({$indice}::text))
                    like UPPER(unaccent('%{$value}%'))"
                );
            }
        }

        return $query;
    }

    /**
     * Utilizado para quando o request vim com array com coluna repetida.
     * Where[][descricao].
     */
    public function arrayWhere(Builder $query, array $where): Builder
    {
        foreach ($where as $indice => $value) {
            if (is_array($value)) {
                $this->arrayWhere($query, $value);
            } else {
                $indice = 'cpfcnpj' == $indice ?
                    "translate({$indice}, '.,-/', '')" : $indice;
                $query->WhereRaw(
                    "UPPER(unaccent({$indice}::text))
                    like UPPER(unaccent('%{$value}%'))"
                );
            }
        }

        return $query;
    }

    /**
     * Utilizado para efetuar o array in.
     * esperado: wherein[collum] = 1,2,3.
     *
     * @throws \Exception
     */
    public function baseWhereIn(Builder $query, array $where = [], array $allowedFields = []): Builder
    {
        foreach ($where as $column => $in) {
            if (!in_array($column, $allowedFields)) {
                throw new \Exception("O indice '{$column}' não esta habilitado!", 1);
            }
            $query->whereIn($column, explode(',', $in));
        }

        return $query;
    }

    /**
     * Utilizado para efetuar o array in.
     * esperado: wherenotin[collum] = 1,2,3.
     *
     * @throws \Exception
     */
    public function whereNotIn(Builder $query, array $where = [], array $allowedFields = []): Builder
    {
        foreach ($where as $column => $in) {
            if (!in_array($column, $allowedFields)) {
                throw new \Exception("O indice '{$column}' não esta habilitado!", 1);
            }
            $query->whereNotIn($column, explode(',', $in));
        }

        return $query;
    }

    /**
     * Escopo Global Between.
     */
    public function scopeBetween(
        Builder $query,
        $column,
        $start,
        $end,
    ): Builder {
        return $query->where($column, '>=', Carbon::parse($start))
            ->where($column, '<=', Carbon::parse($end));
    }

    /**
     * Escopo Global Date.
     */
    public function scopeDate(
        Builder $query,
        string $column,
        string $date,
        string $operator = '=',
    ): Builder {
        return $query->where($column, $operator, Carbon::parse($date));
    }

    protected function checkSegment(HasOne $segment, array $data = []): HasOne
    {
        if (!$segment->exists()) {
            $segment->create($data);
        }

        return $segment;
    }

    /**
     * Get the formated createdAt.
     */
    protected function createdAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d H:i'),
        );
    }

    /**
     * Get the formated updatedAt.
     */
    protected function updatedAt(): Attribute
    {
        return new Attribute(
            get: fn ($value) => Carbon::parse($value)->format('Y-m-d H:i'),
        );
    }
}
