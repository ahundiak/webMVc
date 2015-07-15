<?php
namespace SkooppaOS\webMVc;
/*
 * Our very, very, very thin controller!
 *
 */

use SkooppaOS\webMVc\ClientModelActionFactory;


class Controller
{

    public function __construct(Request $request, Model $model)
    {
            ClientModelActionFactory::doAction($model, $request);
    }

}

