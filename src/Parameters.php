<?php
namespace SkooppaOS\webMVc;

/*
 * This is where we setup the parameters for the request. We are making sure the request matches the logic
 * the client coder is expecting, which comes from the configuration ($clientParameters and $clientPathMap).
 * Obviously we could do things a lot better and differently.
 */

class Parameters
{
    public  $parameters = array();
    private $request;
    public  $parameterKeys;
    public  $clientParameters;
    public  $clientURLPathMap;

    /**
     * Our constructor.
     * @param Request $request
     * @param Configuration $config
     */
    public function __construct(Request $request, Configuration $config)
    {
        $this->request = $request;
        $this->clientParameters = $config->configuration;
        $this->getCurrentObjectConfig();
        $this->getParameterKeys();
        $this->buildParameters();
    }

    /**
     * Gets the config for the object being request.
     */
    private function getCurrentObjectConfig()
    {
        foreach($this->clientParameters as $key => $value){

            if ($key === $this->request->getObject()) {
                $this->clientURLPathMap = $value['urlPathMap'];
                $this->clientParameters = $value['parameters'];
            }
        }


    }

    /**
     * This gets the configured parameters keys, found in the URL.
     */
    private function getParameterKeys()
    {
        $mapElements = explode( '/',$this->clientURLPathMap);
        $mapLength = count($mapElements);
        $this->parameterKeys = array_slice($mapElements, 2, $mapLength - 1);
    }


    /**
     * This builds the parameters necessary to run the system from the config.
     */
    public function buildParameters()
    {
        // this is inflexible, as we can't set up for different parameter needs. Need to refactor.

        if ( $this->request->isRead() ) {
            for($i=0; $i < count($this->parameterKeys); $i++) {
                if(isset($this->request->urlParams[$i])) {
                    $this->parameters[$this->parameterKeys[$i]] = $this->request->urlParams[$i];
                } else {
                    $this->parameters[$this->parameterKeys[$i]] = $this->clientParameters[$this->parameterKeys[$i]];
                }
            }
        }


       if(empty($this->parameters)) {
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
