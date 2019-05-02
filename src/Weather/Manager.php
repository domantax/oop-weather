<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbWeatherRepository;
use Weather\Api\GoogleApi;
use Weather\Model\Weather;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;

    public function getTodayInfo(string $dataSource): Weather
    {
        return $this->getTransporter($dataSource)->selectByDate(new \DateTime(), $dataSource);
    }

    public function getWeekInfo(string $dataSource): array
    {
        return $this->getTransporter($dataSource)->selectByRange(new \DateTime('midnight'), new \DateTime('+6 days midnight'));
    }

    private function getTransporter(string $dataSource): DataProvider
    {

        switch($dataSource) {
            case 'dbData':
            case 'dbWeather':
                if (null === $this->transporter || get_class($this->transporter) !== 'DbRepository') {
                    $this->transporter = new DbWeatherRepository();
                }
                break;
            case 'googleApi':
                if (null === $this->transporter || get_class($this->transporter) !== 'GoogleApi') {
                    $this->transporter = new GoogleApi();
                }
                break;
        }

        return $this->transporter;

//        var_dump($this->transporter);
    }

}


