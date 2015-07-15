<?php

/* Our clock model class
 *
 */

use SkooppaOS\webMVc\ObjectParameters;
use SkooppaOS\webMVc\Request as Request;
//require_once('ObjectParameters.php');


class ClockModel
{

    private $request;
    public $timezones = ['Europe/London' => 'London',
                          'America/New_York' => 'New York',
                          'America/Los_Angeles' => 'Los Angeles'];

    // this is the URL structure. The first elements is always the object, everything after the object will be your object parameters
    // we'll need to come up with a more flexible method later
    public $urlPathMap = '/clock/dataSource/dateFormat';

    // since you have them in your path map above, you must also declare the variable defaults! This should also be automated!
    public $objectParams = ['dataSource' => 'default',
                              'dateFormat' => 'default'];
    public $timezone;
    public $submitted = false;
    public $time;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->getObjectParams();
    }

    private function getObjectParams()
    {
        $objectParameters = new ObjectParameters($this->request, $this->urlPathMap, $this->objectParams);
        $this->objectParams = $objectParameters->parameters;
    }

    public function isValid($post)
    {
        return (null !== isset($post['timezone'])) ? true : false;
    }

    public function getTime()
    {   //var_dump($this->objectParams->parameters);
         if ( $this->objectParams['dataSource'] === 'default' ) {
            $timezone = new DateTimeZone($this->timezone);
            $date = new DateTime;
            $date->setTimeZone($timezone);
            return $date;
        }elseif (  $this->objectParams['dataSource'] === 'ntp' ){
            $date = $this->getNTPTime();
            return $date;
        }
    }

    public function getNTPTime()
    {
        // go and get the time from some NTP server (for now just do the same as default as an example)
        $timezone = new DateTimeZone($this->timezone);
        $date = new DateTime;
        $date->setTimeZone($timezone);
        return $date;
    }

    public function getCity()
    {
        return $this->timezones[$this->timezone];
    }

    public function success()
    {
            $this->submitted = true;
    }
}
