<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function __construct($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getType($model)
    {
        $this->attributes['type'] = $this->where('table_name', $model->getTable())
        ->where('field_name', $this->attributes['name'])
        ->first(['type'])
        ->type;

        if ($this->attributes['type'] === "select") {
            $this->assignOptionsForSelect($model->getTable(), $this->attributes['name']);
        }
    }

    public function assignValue($model)
    {
        $this->attributes['value'] = $model->{$this->attributes['name']} ? $model->{$this->attributes['name']} : '';
    }

    public function addClass(string $name)
    {
        $this->attributes['classes'] = $name;
    }

    protected function assignOptionsForSelect($table, $column)
    {
        $type = \DB::select(\DB::raw("SHOW COLUMNS FROM {$table} WHERE Field = '{$column}'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = array_add($enum, $v, $v);
        }

        $this->attributes['default_values'] = $enum;
    }
}
