<?php

namespace SkooppaOS\webMVc;

/*
 * Create the Request object from global variables.
 */

class Request
{
    public $object;
    public $method;
    public $path;
    public $postData;
    public $urlParams;
    public $parameters;
    public $configuration;

    public function __construct()
    {
        $this->filterPostData();
        $this->setMethod();
        $this->setObject();
        $this->setURLParams();
        $this->setParameters();
    }


    /**
     * This will get our client configuration.
     *
     * @return Configuration
     */
    private function getConfiguration()
    {
         $this->configuration = new Configuration($this->configuration);
         return $this->configuration;
    }

    /**
     *
     */
    private function setMethod()
    {
        if ( ! isset($this->postData['method'] )) {
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
     *  Setting the object of our application. Currently assumes the object is always the first part of the
     *  URL path like /clock or /blog
     *
     */
    private function setObject()
    {
        $urlElements = explode('/', $_SERVER['REQUEST_URI']);
        $this->object = $urlElements[1];
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
     *  Getting the rest of the client parameters
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
        //no filtering yet, but you get the point
        $this->postData = $_POST;

    }


    /**
     * @return bool
     */
    public function isWrite()
    {

        return $this->method == 'update' OR $this->method == 'create' OR $this->method =='delete' ? true : false;

    }

    /**
     * @return bool
     */
    public function isRead()
    {
        return $this->method == 'read'? true : false;
    }

}
