<?php

namespace SkooppaOS\webMVc;
/*
 * A simple factory to build our clientModel's action classes like ObjectUpdate, ObjectCreate, ObjectDelete
 *
 */

use \Exception;


class ClientModelActionFactory
{
    public static function doAction(Model $model, Request $request)
    {
        $class = ucfirst($request->method).ucfirst($request->object);
        var_dump($class);
        require_once __DIR__.'/models/'.$request->object.'/'.$class .'.php';
        if (class_exists($class)) {
            return new $class($model, $request);
        }
        else {
            throw new Exception("Invalid object given.");
        }
    }
}