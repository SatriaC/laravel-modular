<?php

namespace App\Filters;

use Illuminate\Support\Str;

class BaseFilter
{
    protected $model;

    public static function apply($query, $filters = null, $filterClass = null)
    {
        if ($filterClass !== null && $filters !== null) {
            foreach ($filters as $filterName => $value) {
                $method = static::createMethodName($filterName);
                if (static::isMethodExists($filterClass, $method)) {
                    $query = $filterClass->$method($query, $value);
                }
            }
        }

        return $query;
    }

    public static function createMethodName($method)
    {
        return Str::studly('filter' . $method);
    }

    public static function isMethodExists($class, $method)
    {
        return method_exists($class, $method);
    }

    // SORTIR LOGIC
    public function filterSort($query, $value)
    {
        $value = str_replace(" ", "", $value);
        $fillables = $this->model->getFillable();
        $fillables = array_flip($fillables);

        if (strpos($value, ",") !== false) {
            $explodes = explode(",", $value);
            foreach ($explodes as $idx => $field) {
                $cleanField = str_replace("-", "", $field);
                if (!array_key_exists($cleanField, $fillables)) {
                    unset($explodes[$idx]);
                }
            }

            foreach ($explodes as $idx => $field) {
                $cleanField = str_replace("-", "", $field);
                $sortType = "ASC";
                if (strpos($field, "-") !== false) {
                    $sortType = "DESC";
                }

                $query = $query->withoutGlobalScope('order')->orderBy($cleanField, $sortType);
            }
        } else {
            $cleanField = str_replace("-", "", $value);
            $sortType = "ASC";
            if (array_key_exists($cleanField, $fillables)) {
                if (strpos($value, "-") !== false) {
                    $sortType = "DESC";
                }

                $query = $query->withoutGlobalScope('order')->orderBy($cleanField, $sortType);
            }
        }
        return $query;
    }
}
