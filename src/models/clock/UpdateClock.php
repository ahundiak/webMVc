<?php
namespace models\clock;

/*
 * Our class for updating the clock model.
 *
 */


use SkooppaOS\webMVc\Model;
use SkooppaOS\webMVc\Request as Request;

class UpdateClock
{
    public function __construct(Request $request, Model $model)
    {
        if ($this->isValid($request->postData) ) {

            $model->clock->success();
            $model->clock->timezone = $request->postData['timezone'];
        }
    }

    public function isValid($post)
    {
        return (null !== isset($post['timezone'])) ? true : false;
    }
}