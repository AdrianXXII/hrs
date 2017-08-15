<?php

namespace App;

trait InactivateTrait
{
    public function inactivate()
    {
        $this->active = 0;
        $this->update();

        return true;
    }
}