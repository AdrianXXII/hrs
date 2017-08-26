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

    public function isInactive()
    {
        if (! $this->active)
        {
            return true;
        }
    }
}