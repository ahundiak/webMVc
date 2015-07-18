<?php
/**
 *  Our Blog Model
 */

use SkooppaOS\webMVc\Request as Request;

class Blog
{

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->parameters = $request->parameters;
    }

}