<?php


namespace Weather\Api;


use Weather\Model\Weather;

class DbWeatherRepository extends AbstractDb
{
    public function __construct()
    {
        $this->db = 'Weather.json';
    }

    /**
     * @return Weather[]
     */
    protected function selectAll(): array
    {
        $data = json_decode(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'Db' . DIRECTORY_SEPARATOR . $this->db),
            true
        );
        $result = [];

        foreach ($data as $item) {
            $record = new Weather();
            $record->setDate(new \DateTime($item['date']));
            $record->setDayTemp($item['high']);
            $record->setNightTemp($item['low']);
            $record->setSky($this->changeSkyTextToId($item['text']));
            $result[] = $record;
        }

        return $result;
    }

    /**
     * @param string $text
     *
     * @return int
     */
    private function changeSkyTextToId(string $text): int
    {
        switch (trim($text)) {
            case 'Cloudy':
            case 'Mostly Cloudy':
            case 'Partly Cloudy':
                $id = 1;
                break;
            case 'Scattered Showers':
                $id = 2;
                break;
            case 'Sunny':
            case 'Breezy':
                $id = 3;
                break;
        }

        return $id;
    }
}