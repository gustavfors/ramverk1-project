<?php

namespace Gufo\Commons;

trait ValidationTrait
{
    public function isBlank($value)
    {
        return empty($value);
    }
}
