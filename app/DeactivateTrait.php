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
}