<?php
namespace models\blogAdmin;

/**
 * Our Blog Admin Model
 */

use SkooppaOS\webMVc\Request;
use models\blog\Blog;

class BlogAdmin extends Blog
{

    /**
     * Our constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

}