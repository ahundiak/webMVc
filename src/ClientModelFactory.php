<?php

namespace SkooppaOS\webMVc;

/*
 * A stimple factory to build our clientModels
 *
 */


class ClientModelFactory
{
    public static function build(Request $request)
    {
        $class = (ucfirst($request->object));
        require_once __DIR__.'/models/'.$request->object.'/'. $class .'.php';
        if (class_exists($class)) {
            return new $class($request);
        }
        else {
            throw new Exception("Invalid object given.");
        }
    }
}