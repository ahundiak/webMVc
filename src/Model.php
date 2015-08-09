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
    public $protectedObjects = array();


    /**
     * Our constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->clientModelName = $this->request->getObject();
        $this->buildClientModel();
    }

    /**
     * This method builds the required object.
     * @return mixed
     */
    public function buildClientModel()
    {
        $this->{$this->clientModelName} = ClientModelFactory::build($this->request);

        return $this->{$this->clientModelName};
    }

    /**
     * This builds secondary objects, determined through the included templates.
     * @param $secondaryModelName
     * @return mixed
     */
    public function buildSecondaryClientModel($secondaryModelName)
    {
        $this->{$secondaryModelName} = ClientModelFactory::build($this->request, $secondaryModelName);
        return $this->{$secondaryModelName};
    }
}