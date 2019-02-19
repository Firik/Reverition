<?php

namespace vvkosty\reverition\Facades;

use Illuminate\Support\Facades\Facade;

class RevertitionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'gifService';
    }
}