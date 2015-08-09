<?php
namespace SkooppaOS\webMVc;

/*
 * A stimple factory to build our clientModels
 *
 */


class ClientModelFactory
{
    /**
     * This sets up our main models, determined by the object requested.
     * @param Request $request
     * @param null $secondaryObject
     * @return mixed
     */
    public static function build(Request $request, $secondaryObject = null)
    {
        if (null !== $secondaryObject){
            $directory = $secondaryObject;
            $class = (ucfirst($secondaryObject));
        } else {
            $directory = $request->getObject();
            $class = (ucfirst($request->getObject()));
        }

        if (file_exists(__DIR__.'/../app/models/'.$directory.'/'. $class .'.php')) {
            require_once (__DIR__ . '/../app/models/' . $directory . '/' . $class . '.php');
        }

        $nameSpace = "models\\".$directory."\\";
        $fqcn = $nameSpace.$class;

        if (class_exists($fqcn)) {
            return new $fqcn($request);
        } else {
           $request->setObject('error');
            //Not working yet!
            //$request->parameters['errorCode'] = 404;
           $request->refreshPage();
        }
    }
}