<?php
namespace SkooppaOS\webMVc;

/*
 * A simple factory to build our clientModel's action classes like ObjectUpdate, ObjectCreate, ObjectDelete
 *
 */


class ClientModelActionFactory
{
    /**
     * This sets up our "action models", determined by the requested object.
     * @param Request $request
     * @param Model $model
     * @return mixed
     */
    public static function doAction(Request $request, Model $model)
    {
        $class = (ucfirst($request->method).ucfirst($request->getObject()));
        $directory = $request->getObject();

        if (file_exists(__DIR__.'/models/'. $directory .'/'. $class .'.php')) {

            require_once (__DIR__ . '/models/' . $directory . '/' . $class . '.php');
        }

        $nameSpace = "models\\".$directory."\\";
        $fqcn = $nameSpace . $class;

        if (class_exists($fqcn)) {

            return new $fqcn($request, $model);

        } else {

            $request->setObject('error');
            $request->refreshPage();
        }
    }
}