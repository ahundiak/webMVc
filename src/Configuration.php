<?php
namespace SkooppaOS\webMVc;
/**
 * A class which loads the client configuration
 *
 */

class Configuration
{
    public $configuration = array();

    /**
     *
     */
    public function __construct($config)
    {
        // make sure we are only loading the config file once
        if ($config !== null) {
            $this->configuration = $config;
        } else {
            include_once (__DIR__ . '/../config/config.php');
            $this->configuration =& $config;
        }
    }
}