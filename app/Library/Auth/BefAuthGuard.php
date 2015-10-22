<?php namespace App\Library\Auth;

use Illuminate\Auth\Guard;

class BefAuthGuard extends Guard
{
    public function readLevel()
    {
        $readlevel = 0;
        if ($this->check()) {
            $readlevel = $this->user->read_level;
        }
        return $readlevel;
    }
}
