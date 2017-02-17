<?php


namespace RocketShipit;


class Config
{
    /**
     * @var array
     */
    public $parameters = [];

    public function setDefault($section, $key, $value)
    {
        $this->parameters[$section][$key] = $value;
    }
}
