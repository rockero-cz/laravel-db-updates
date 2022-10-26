<?php

namespace Rockero\DatabaseUpdates\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Rockero\DatabaseUpdates\DatabaseUpdates
 */
class DatabaseUpdates extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Rockero\DatabaseUpdates\DatabaseUpdates::class;
    }
}
