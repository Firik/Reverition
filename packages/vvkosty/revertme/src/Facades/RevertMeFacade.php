<?php

namespace vvkosty\revertme\Facades;

use Illuminate\Support\Facades\Facade;

class RevertMeFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'gifService';
    }
}