<?php

namespace Weather\Controller;

use Weather\Manager;
use Weather\Model\NullWeather;

class StartPage
{
    /**
     * @param string $dataSource
     *
     * @return array
     */
    public function getTodayWeather(string $dataSource): array
    {
        try {
            $service = new Manager($dataSource);
            $weather = $service->getTodayInfo();
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return [
            'template' => 'today-weather.twig',
            'context' => ['weather' => $weather],
        ];
    }

    /**
     * @param string $dataSource
     *
     * @return array
     */
    public function getWeekWeather(string $dataSource): array
    {
        try {
            $service = new Manager($dataSource);
            $weathers = $service->getWeekInfo();
        } catch (\Exception $exp) {
            $weathers = [];
        }

        return [
            'template' => 'range-weather.twig',
            'context' => ['weathers' => $weathers],
        ];
    }
}
