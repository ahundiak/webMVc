<?php
namespace SkooppaOS\webMVc;

/*
 * A converter to convert HTTP to a request object and handle it to get a response
 *
 */

class HTTPConverter
{

    public  $request;
    private $response;
    private $controller;
    public  $model;
    public  $firewall;

    /**
     * Our constructor.
     */
    public function __construct()
    {
        // currently nothing to construct
    }


    /**
     * This builds our request object.
     */
    public function createRequest()
    {
        return $this->request = new Request();
    }

    /**
     * This controls the activity within the MVC model.
     * As you can see, it goes from the request, and depending on
     * what the request is, we go to either the controller of the view directly.
     */
    public function handleRequest()
    {
        $this->model = new Model($this->request);

        $this->request->firewall = new Firewall($this->request);
        $this->request->firewall->authenticate();


        if ( $this->request->isWrite() ) {

            $this->controller = new Controller($this->request, $this->model);
        }

        // you'll always need a response, so call the view to get it.
        $this->response = new View($this->request);
    }

    /**
     * Here we send the response.
     * We should have probably added a response object.
     * Maybe later?
     *
     */
    public function sendResponse()
    {
        if ($this->request->refreshPage) {
            $this->request->setSession();
            header('Location: http://'.$_SERVER[HTTP_HOST].'/'.$this->request->getObject());
            exit();
        }

        $this->request->setSession();

        echo  $this->response->render($this->model);

    }
}

