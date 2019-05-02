<?php

namespace Weather;

use Weather\Api\DataProvider;
use Weather\Api\DbDataRepository;
use Weather\Api\DbWeatherRepository;
use Weather\Api\GoogleApi;
use Weather\Model\Weather;

class Manager
{
    /**
     * @var DataProvider
     */
    private $transporter;

    public function __construct($dataSource)
    {
        $this->transporter = $this->getTransporter($dataSource);
    }

    /**
     * @return \Weather\Model\Weather
     * @throws \Exception
     */
    public function getTodayInfo(): Weather
    {
        return $this->transporter->selectByDate(new \DateTime());
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function getWeekInfo(): array
    {
        return $this->transporter->selectByRange(new \DateTime('midnight'),
            new \DateTime('+6 days midnight'));
    }

    /**
     * @param string $dataSource
     *
     * @return \Weather\Api\DataProvider
     */
    private function getTransporter(string $dataSource): DataProvider
    {
        switch ($dataSource) {
            case 'dbData':
                if (null === $this->transporter || get_class($this->transporter) !== 'DbRepository') {
                    $dataTransporter = new DbDataRepository();
                }
                break;
            case 'dbWeather':
                if (null === $this->transporter || get_class($this->transporter) !== 'DbRepository') {
                    $dataTransporter = new DbWeatherRepository();
                }
                break;
            case 'googleApi':
                if (null === $this->transporter || get_class($this->transporter) !== 'GoogleApi') {
                    $dataTransporter = new GoogleApi();
                }
                break;
        }

        return $dataTransporter;
    }
}


