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
    public $urlParamCount;

    public function __construct()
    {
       $this->setObject();
       $this->setURLParams();
       $this->filterPostData();
       $this->setMethod();

    }

    private function setObject()
    {
        $urlElements = explode('/', $_SERVER['REQUEST_URI']);
        $this->object = $urlElements[1];
    }

    private function setURLParams()
    {
        $urlElements = explode('/', $_SERVER['REQUEST_URI']);
        // because the object is always the first element and we already define its own variable, drop it
        $this->urlParams = array_slice($urlElements, 2);
        $this->urlParamCount = count($this->urlParams);


    }


    private function filterPostData()
    {
        //no filtering yet, but you get the point
        $this->postData = $_POST;
        return $this->postData;
    }

    private function setMethod()
    {
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

            default: 'read';
        }
    }

    public function isWrite()
    {

        return $this->method == 'update' OR $this->method == 'create' OR $this->method =='delete' ? true : false;

    }

    public function isRead()
    {
        return $this->method == 'read'? true : false;
    }

}
