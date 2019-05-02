<?php

namespace Weather\Api;

use Weather\Model\NullWeather;
use Weather\Model\Weather;

class GoogleApi implements DataProvider
{
    /**
     * @return Weather
     * @throws \Exception
     */
    public function selectByDate(\DateTime $date): Weather
    {
        $dayWeather = $this->load(new NullWeather());
        $dayWeather->setDate(new \DateTime());

        return $dayWeather;
    }

    public function selectByRange(\DateTime $from, \DateTime $to): array
    {
        $result = [];



//        var_dump($end);
        $end = $to->modify('+1 day');

        $interval = new \DateInterval('P1D');

        $daterange = new \DatePeriod($from, $interval ,$end);

        foreach($daterange as $date){

            $dayWeather = $this->load(new NullWeather());
            $dayWeather->setDate($date);
            $result[] = $dayWeather;
        }

        return $result;
    }


    /**
     * @param Weather $before
     * @return Weather
     * @throws \Exception
     */
    private function load(Weather $before)
    {
        $now = new Weather();
        $base = $before->getDayTemp();
        $now->setDayTemp(random_int(5 - $base, 5 + $base));

        $base = $before->getNightTemp();
        $now->setNightTemp(random_int(-5 - abs($base), -5 + abs($base)));

        $now->setSky(random_int(1, 3));

        return $now;
    }
}
