<?php
namespace models\login;
/**
 * Class to remove the logged in status and return user back to guest
 */

use SkooppaOS\webMVc\Request;


class DeleteLogin
{
    public $request;

    /**
     * All we have is our constructor.
     * It logs the user out then redirects.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->request->firewall->authentication->logOut();
        $this->request->setObject($this->request->getRedirectObject());
        $this->request->refreshPage();
    }

}