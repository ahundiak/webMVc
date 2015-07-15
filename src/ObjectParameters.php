<?php
namespace SkooppaOS\webMVc;
/*
 * This is where we setup the object parameters.
 */

class ObjectParameters
{
    public $parameters = array();
    private $request;
    private $clientURLPathMap;
    private $parameterKeys;
    public $defaultObjectParameters;

    public function __construct(Request $request, $urlPathMap, $defaulObjectParameters )
    {
        $this->request = $request;
        $this->defaultObjectParameters = $defaulObjectParameters;
        $this->clientURLPathMap = $urlPathMap;
        $this->setParameterKeys();
        $this->buildParameters();
    }

    private function setParameterKeys()
    {
         $mapElements = explode( '/',$this->clientURLPathMap);
         $mapLength = count($mapElements);
         $this->parameterKeys = array_slice($mapElements, 2, $mapLength - 1);

    }

    public function buildParameters()
    {
        // this is in flexible, as we can't set up for different parameter needs. Need to refactor.
        if ( $this->request->isRead() AND $this->request->urlParamCount === count($this->parameterKeys) ) {
            for($i=0; $i < $this->request->urlParamCount; $i++) {
                $this->parameters[$this->parameterKeys[$i]] = $this->request->urlParams[$i];
            }
       }else{
           $this->parameters = $this->defaultObjectParameters;
       }

       // this is ugly. Refactor later. But, needed to set up hidden fields for our parameters.
       if ( $this->request->isWrite() ) {
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
