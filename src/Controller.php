<?php
namespace SkooppaOS\webMVc;
/*
 * Our very, very, very thin controller!
 *
 */


class Controller
{

    public function __construct(Request $request, Model $model)
    {
            ClientModelActionFactory::doAction($model, $request);
    }

}

