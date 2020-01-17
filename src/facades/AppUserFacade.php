<?php

namespace Kashtanivan\Box\Facades;

use Illuminate\Support\Facades\Facade;

class AppUserFacade extends Facade {
    protected static function getFacadeAccessor() { return 'boxappuser'; }
}
