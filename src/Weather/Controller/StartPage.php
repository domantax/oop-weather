<?php

namespace Weather\Controller;

use Weather\Manager;
use Weather\Model\NullWeather;

class StartPage
{
    public function getTodayWeather(string $dataSource): array
    {
        try {
            $service = new Manager();
            $weather = $service->getTodayInfo($dataSource);
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return ['template' => 'today-weather.twig', 'context' => ['weather' => $weather]];
    }

    public function getWeekWeather(string $dataSource): array
    {
        try {
            $service = new Manager();
            $weathers = $service->getWeekInfo($dataSource);
        } catch (\Exception $exp) {
            $weathers = [];
        }

        return ['template' => 'range-weather.twig', 'context' => ['weathers' => $weathers]];
    }
}
