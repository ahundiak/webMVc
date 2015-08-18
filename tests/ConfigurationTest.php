<?php

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
  public function test()
  {
    $config = new SkooppaOS\webMVc\Configuration();

    $this->assertEquals('/clock/dataSource/dateFormat',$config->configuration['clock']['urlPathMap']);
  }
}