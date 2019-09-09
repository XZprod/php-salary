<?php

namespace App;

class FormHelper
{
    public static function getDropdown($className, $name, $key = 'id', $value = 'name')
    {
        $models = $className::find();
        $dropdown = '';
        if ($models) {
            $dropdown = '<select name="' . $name . '">';
            foreach ($models as $model) {
                $dropdown .= '<option value="' . $model->{$key} . '">' . $model->{$value} . '</option>';
            }
            
            $dropdown.= '</select>';
        }
        return $dropdown;
    }
}