<?php
namespace SkooppaOS\webMVc;
/*
 * This is where we setup the parameters for the request. We are making sure the request matches the logic
 * the client coder is expecting, which comes from the configuration.
 */

class Parameters
{
    public $parameters = array();
    private $request;
    public $parameterKeys;
    public $clientParameters;
    public $clientURLPathMap;

    public function __construct(Request $request, Configuration $config)
    {
        $this->request = $request;
        $this->clientParameters = $config->configuration;
        $this->getCurrentObjectConfig();
        $this->getParameterKeys();
        $this->buildParameters();
    }

    private function getCurrentObjectConfig()
    {
        foreach($this->clientParameters as $key => $value){
            if ($key === $this->request->object) {
                $this->clientURLPathMap = $value['urlPathMap'];
                $this->clientParameters = $value['parameters'];
            }
        }


    }

    private function getParameterKeys()
    {
         $mapElements = explode( '/',$this->clientURLPathMap);
         $mapLength = count($mapElements);
         $this->parameterKeys = array_slice($mapElements, 2, $mapLength - 1);

    }


    public function buildParameters()
    {
        // this is inflexible, as we can't set up for different parameter needs. Need to refactor.
        if ( $this->request->isRead() AND count($this->request->urlParams) === count($this->parameterKeys) ) {
            for($i=0; $i < count($this->request->urlParams); $i++) {
                $this->parameters[$this->parameterKeys[$i]] = $this->request->urlParams[$i];
            }
       }else{
           $this->parameters = $this->clientParameters;
       }

       // this is ugly. Refactor later. But, needed to set up hidden fields for our parameters.
       if ( $this->request->isWrite() && $this->request->postData !== null ) {
           foreach( $this->request->postData as $key => $value ) {
               foreach ( $this->parameterKeys as $parameterKey ) {
                   if ( $key === $parameterKey ) {
                       $this->parameters[$parameterKey] = $value;
                   }
               }
           }
       }
    }
}
