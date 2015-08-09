<?php
namespace models\index;

/**
 * Our index class
 */


class Index
{
    public $aVariable;

    /**
     * Our constructor.
     */
    public function __construct()
    {
        $this->aVariable = 'This is the webMVc starting page. Nothing fantastic.
                             <br/>
                             <br/>
                             Just a small example index page.';
    }
}