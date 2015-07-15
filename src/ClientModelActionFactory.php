<?php
namespace SkooppaOS\webMVc;
/*
 * A stimple factory to build our clientModel's action classes like ObjectUpdateModel, ObjectCreateModel, ObjectDeleteModel
 *
 */


class ClientModelActionFactory
{
    public static function doAction(Model $model, Request $request)
    {
        $class = (ucfirst($request->method).ucfirst($request->object))."Model";
        require_once __DIR__.'/models/'.$request->object.'/'. $class .'.php';
        if (class_exists($class)) {
            return new $class($model, $request);
        }
        else {
            throw new Exception("Invalid object given.");
        }
    }
}