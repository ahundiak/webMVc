<?php
namespace models\login;
/**
 * Class for updating Authentication through the login.
 */

use SkooppaOS\webMVc\Request;


class UpdateLogin
{
    private $request;

    /**
     * Constructor - only sets up a redirect.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

        if($this->request->session['loggedIn'] === true) {
           $this->request->setObject($this->request->getRedirectObject());
           $this->request->refreshPage();
        }

    }
}