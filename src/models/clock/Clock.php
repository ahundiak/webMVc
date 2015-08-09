<?php
namespace models\clock;

/* Our clock model class
 *
 */

use SkooppaOS\webMVc\Request;

class Clock
{

    private $request;
    public $timezones = ['Europe/London' => 'London',
                          'America/New_York' => 'New York',
                          'America/Los_Angeles' => 'Los Angeles'];

    public $timezone;
    public $submitted = false;
    public $time;
    public $parameters;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->parameters = $request->parameters;
    }

    public function getTime()
    {
         if ( $this->request->parameters['dataSource'] === 'default' ) {
            $timezone = new \DateTimeZone($this->timezone);
            $date = new \DateTime;
            $date->setTimeZone($timezone);
            return $date;
        }elseif (  $this->request->parameters['dataSource'] === 'ntp' ){
            $date = $this->getNTPTime();
            return $date;
        }
    }

    public function getNTPTime()
    {
        // go and get the time from some NTP server (for now, we doing the same as the default, as an example)
        $timezone = new   \DateTimeZone($this->timezone);
        $date = new \DateTime;
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
