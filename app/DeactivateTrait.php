<?php

namespace App;

trait DeactivateTrait
{
    public function deactivate()
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