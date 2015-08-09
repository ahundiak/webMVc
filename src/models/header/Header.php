<?php
namespace models\header;

/**
 * A class for the header data, which demonstrates recursive template model instantiation
 */

use SkooppaOS\webMVc\Request;

class Header
{
    public $aVariable;

    /**
     * Our constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->aVariable = 'Welcome! This is the '. $request->getObject() .' section.';
    }
}