<?php
namespace SkooppaOS\webMVc;

/*
 * Our very, very, very thin controller!
 * The thinnest controller in the world!
 *
 */


class Controller
{

    public function __construct(Request $request, Model $model)
    {
            ClientModelActionFactory::doAction($request, $model);
    }

}

