<?php

namespace App\Exceptions;

class EmptyCollectionException extends \Exception
{
    public function render()
    {
        abort(404);
    }
}