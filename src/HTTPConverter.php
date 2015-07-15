<?php

namespace SkooppaOS\webMVc;
/*
 * A converter to convert HTTP to a request object and handle it to get a response
 *
 */

//use SkooppaOS\webMVc\Request;
//use SkooppaOS\webMVc\View;
//use SkooppaOS\webMVc\Controller;
//use SkooppaOS\webMVc\Model;

class HTTPConverter
{

    private $request;
    private $response;
    private $controller;
    private $model;


    public function __construct()
    {

        // prepare anything necessary

    }


    public function createRequest()
    {
        // create the request object
        $this->request = new Request();

    }

    public function handleRequest()
    {
        $this->model = new Model($this->request);

        // if the request is a write request, do the controller first
        if ( $this->request->isWrite() ) {
            $this->controller = new Controller($this->request, $this->model);
        }

        // you'll always need a response, so call the view to get it.
        $this->response = new View($this->request);
    }

    public function sendResponse()
    {
        echo  $this->response->render($this->model);

    }

}

