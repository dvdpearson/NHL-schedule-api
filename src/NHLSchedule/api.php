<?php
namespace NHLSchedule;

use \Klein\Klein;

class Api {

    public function dispatch()
    {
        // Using klein package for routing
        $klein = new Klein();

        $klein->respond('GET', '/games', function () {
            echo json_encode(simplexml_load_string($this->getGames()));
        });

        $klein->dispatch();
    }

    private function getGames()
    {
        $xml = new ScheduleImporter();
        $xml->import();
        return $xml->getXml()->saveXML();
    }
}
