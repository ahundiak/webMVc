<?php

namespace SkooppaOS\webMVc;
/**
 *  Our Authentication Class
 */

class Authentication
{
    private $password = 'password';
    public $errorMessage = '';

    /**
     * Our constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;

    }

    /**
     * Logs in the users by setting a session variable.
     */
    public function logIn()
    {
        if ($this->passwordIsOk()) {

            $this->request->session['loggedIn'] = true;
            return;
        }

        if ($this->passwordNotOk() ) {

            $this->errorMessage = 'Ooops, the password is wrong!';
        }
    }

    /**
     * Check to see if the user is logged in.
     * @return bool
     */
    public function isLoggedIn()
    {
        return isset($this->request->session['loggedIn']) && $this->request->session['loggedIn'] === true;
    }

    /**
     * Checks if the password is correct. This is not the way it should be done!
     * @return bool
     */
    private function passwordIsOk()
    {
        return isset($this->request->postData['password']) &&
        $this->password === $this->request->postData['password'];
    }

    /**
     * This will return true, should the password be incorrect.
     * @return bool
     */
    private function passwordNotOk()
    {
        return isset($this->request->postData['password']) &&
        $this->password !== $this->request->postData['password'];
    }

    /**
     * This logs the user back out.
     */
    public function logOut()
    {
        $this->request->session['loggedIn'] = false;
    }

}