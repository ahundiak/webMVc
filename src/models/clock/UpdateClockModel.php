<?php

/*
 * Our class for updating the clock model.
 *
 */

use SkooppaOS\webMVc\Model as Model;
use SkooppaOS\webMVc\Request as Request;

class UpdateClockModel
{
    public function __construct(Model $model, Request $request)
    {
        if ( $model->clock->isValid($request->postData) ) {
            $model->clock->success();
            $model->clock->timezone = $request->postData['timezone'];
        }
    }

}