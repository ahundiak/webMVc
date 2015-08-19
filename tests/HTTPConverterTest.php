<?php

use SkooppaOS\webMVc\Request;
use SkooppaOS\webMVc\HTTPConverter;

class HTTPConverterTest extends \PHPUnit_Framework_TestCase
{
  public function testCreateRequest()
  {
    $httpConverter = new HTTPConverter();

    $_SERVER['REQUEST_METHOD'] = 'GET';

    $_SERVER['REQUEST_URI'] = '/';

    //$_SERVER['REQUEST_URI'] = '/blog/slug/id';

    $request = $httpConverter->createRequest();
    $this->assertTrue($request instanceof Request);
  }
}