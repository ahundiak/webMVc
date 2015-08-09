<?php
namespace SkooppaOS\webMVc;

/**
 * A class which loads the firewall configuration
 *
 */

class Firewall
{
    public  $request;
    public  $protectedObjects = array();
    public  $authentication;

    /**
     * Our constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        include_once (__DIR__ . '/../config/firewall.php');
        $this->protectedObjects =& $protectedObjects;
        $this->authentication = new Authentication($this->request);
    }

    /**
     * This function is called, when an authentication is required.
     */
    public function authenticate()
    {
        if (in_array($this->request->getObject(), $this->protectedObjects)) {

            $this->authentication->logIn();

            if ( ! $this->authentication->isLoggedIn()) {
                $this->request->setObject('login');
            }
        }
    }
}