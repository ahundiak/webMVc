<?php
namespace SkooppaOS\webMVc;
/*
 * A class for our model (building)
 *
 */



class Model {

    private $request;
    public $clientModelName;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->clientModelName = $this->request->object;
        $this->buildClientModel();

    }

    public function buildClientModel()
    {
        $this->{$this->clientModelName} = ClientModelFactory::build($this->request);
        return $this->{$this->clientModelName};
    }

}