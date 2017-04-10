<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $model;

    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function prepareColumns($table, $columns)
    {

        foreach ($columns as $key => $value) {
            $new_columns[] = $this->where('table_name', $table)
                ->where('column_name', $value)
                ->first();

            $last = $this->lastItem($new_columns);

            if ($this->isSelect($new_columns[$last])) {
                $this->assignOptionsForSelect($table, $new_columns[$last]);
            }

            if (empty($new_columns[$last])) {
                unset($new_columns[$last]);
            }
            $new_columns[$last]->value = $this->assignValues($new_columns[$last]->column_name);
        }
        return $new_columns;
    }


    protected function assignOptionsForSelect($table, $column)
    {
        $type = \DB::select(\DB::raw("SHOW COLUMNS FROM {$table} WHERE Field = '{$column->column_name}'"))[0]->Type;

        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = array_add($enum, $v, $v);
        }

        return $column->default_values = $enum;
    }

    protected function isSelect($column)
    {
        if ($column->type === "select") {
            return true;
        }

        return false;
    }
    protected function lastItem($array)
    {
        end($array);
        return key($array);
    }

    protected function assignValues($column)
    {
        if ($this->model) {
            return $this->model->$column;
        }

        return '';
    }
}
