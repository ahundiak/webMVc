<?php
namespace SkooppaOS\webMVc;

/*
 * Class for building the Request object.
 */

class Request
{
    private $object;
    private $redirectObject;
    public  $method;
    public  $path;
    public  $postData;
    public  $urlParams;
    public  $parameters;
    public  $configuration;
    public  $session;
    public  $refreshPage = false;
    public  $firewall;



    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->filterPostData();
        $this->setMethod($this->method);
        $this->setObject();
        $this->setRedirectObject();
        $this->setURLParams();
        $this->setParameters();
        $this->initializeSession();
        $this->cleanup();
    }


    /**
     * This will get our client's configuration.
     *
     * @return Configuration
     */
    private function getConfiguration()
    {
        $this->configuration = new Configuration($this->configuration);
        return $this->configuration;
    }

    /**
     * Setting the method of the system, from the input or client parameters
     * @param $newMethod
     */
    private function setMethod($newMethod = null)
    {
        if($newMethod !== null) {
            $this->method = $newMethod;
            return;
        }

        if (!isset($this->postData['method'])) {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'POST':
                    $this->method = 'update';
                    break;

                case 'PUT':
                    $this->method = 'create';
                    break;

                case 'DELETE':
                    $this->method = 'delete';
                    break;

                case 'GET' :
                    $this->method = 'read';
                    break;

                default:
                    'read';
            }
        } else {
            $this->method = $this->postData['method'];
        }
    }

    /**
     * @return mixed
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     *  Setting the object of our application. Currently assumes the object is always the first part of the
     *  URL path like /clock or /blog
     *
     * @param null $object
     */
    public function setObject($object = null)
    {
        if ($object !== null) {
            $this->object = $object;
            return;
        }
        $urlElements = explode('/', $_SERVER['REQUEST_URI']);
        if ($urlElements[1] !== '') {
            $this->object = $urlElements[1];
            return;
        }
        // if no object, go to index
        $this->object = 'index';
    }

    public function setRedirectObject($redirectObject = null)
    {
        if ($redirectObject !== null) {
            $this->redirectObject = $redirectObject;
            return;
        }

        if(isset($this->postData['redirectObject'])) {
            $this->redirectObject = $this->postData['redirectObject'];
            return;
        }

        $this->redirectObject = $this->getObject();
    }

    /**
     * @return mixed
     */
    public function getRedirectObject()
    {
        return $this->redirectObject;
    }

    /**
     *  Setting the rest of the parameters out of the URL
     */
    private function setURLParams()
    {
        $urlElements = explode('/', $_SERVER['REQUEST_URI']);
        // because the object is always the first element and we already defined it, drop it from the URL
        $this->urlParams = array_slice($urlElements, 2);
        $this->path = $_SERVER['REQUEST_URI'];
    }

    /**
     *  Setting the rest of the parameters
     */
    private function setParameters()
    {
        $this->parameters = new Parameters($this, $this->getConfiguration());
        $this->parameters = $this->parameters->parameters;
    }


    /**
     *
     */
    private function filterPostData()
    {
        //@todo - No filtering yet. If this ever does become a framework, this needs updating badly!!!
        $this->postData = $_POST;
    }

    /**
     *
     */
    public function initializeSession()
    {
        session_start();
        if (isset($_SESSION)) {
            $this->session = $_SESSION;
            if (empty($this->session)) {
                $this->session['loggedIn'] = '';
            }
        } else {
            $this->session = '';
        }
    }

    /**
     *
     */
    public function setSession()
    {
        $_SESSION = $this->session;
    }

    /**
     * @return bool
     */
    public function isWrite()
    {

        return $this->method == 'update' OR $this->method == 'create' OR $this->method == 'delete' ? true : false;

    }

    /**
     * @return bool
     */
    public function isRead()
    {
        return $this->method == 'read' ? true : false;
    }

    /**
     *
     */
    public function refreshPage()
    {
        $this->refreshPage = true;
    }

    /**
     *
     */
    private function cleanup()
    {
        unset($this->configuration);
    }

}
