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
    public function __construct()
    {
        require (__DIR__ . '/../config/config.php');
        $this->configuration =& $config;

    }
}