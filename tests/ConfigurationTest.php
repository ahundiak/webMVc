<?php

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
  public function test1()
  {
    $config = new SkooppaOS\webMVc\Configuration();

    $this->assertEquals('/clock/dataSource/dateFormat',$config->configuration['clock']['urlPathMap']);
  }
  public function test2()
  {
    $config = new SkooppaOS\webMVc\Configuration();

    $this->assertEquals('/clock/dataSource/dateFormat',$config->configuration['clock']['urlPathMap']);
  }
}