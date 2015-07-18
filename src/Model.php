<?php
namespace SkooppaOS\webMVc;
/*
 * A class for our model (building)
 *
 */



class Model
{

    public $request;
    public $clientModelName;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->clientModelName = $this->request->object;
        $this->isAuthorized();
        $this->buildClientModel();

    }

    public function buildClientModel()
    {
        $this->{$this->clientModelName} = ClientModelFactory::build($this->request);
        return $this->{$this->clientModelName};
    }

    public function isAuthorized()
    {

    }

}