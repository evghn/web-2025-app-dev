<?php

namespace core\models;

class BaseModel
{
    public function load(array $data = [])
    {
        $fields = get_object_vars($this);
        foreach ($data as $key => $val) {
            if (array_key_exists($key, $fields)) {
                $this->$key = $val;
            }
        }
    }
}
