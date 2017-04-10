<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    public $model;

    public function __construct(array $fields, $controller)
    {
        $this->model = $controller->model;
        foreach ($fields as $fieldName) {
            $this->addField($fieldName);
        }
    }

    public function addField($fieldName)
    {
        $field = new Field($fieldName);
        $field->getType($this->model);

        $field->assignValue($this->model);

        $this->attributes['fields'][$fieldName] = $field;
    }
}
