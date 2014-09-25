<?php
namespace NHLSchedule;

use \Klein\Klein;

/**
 * Class Api
 * @package NHLSchedule
 */
class Api {

    /**
     * @var string
     */
    private $season;

    /**
     * @param $season
     */
    public function __construct($season)
    {
        $this->setSeason($season);
    }

    /**
     *
     */
    public function dispatch()
    {
        // Using klein package for routing
        $klein = new Klein();

        $klein->respond('GET', '/games', function () {
            echo json_encode(simplexml_load_string($this->getGames()));
        });

        $klein->dispatch();
    }

    /**
     * @return mixed
     */
    private function getGames()
    {
        $xml = new ScheduleImporter();

        if (!file_exists(__DIR__.'\..\..\xml\\'.$this->getSeason().'.xml')) {
            $xml->import();
            $xml->saveToFile(__DIR__.'\..\..\xml\\'.$this->getSeason().'.xml');
        }

        $xml->setXml(simplexml_load_file(__DIR__.'\..\..\xml\\'.$this->getSeason().'.xml'));

        return $xml->getXml()->saveXML();
    }

    /**
     * @return string
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param $season
     * @return $this
     */
    public function setSeason($season)
    {
        $this->season = $season;
        return $this;
    }


}
