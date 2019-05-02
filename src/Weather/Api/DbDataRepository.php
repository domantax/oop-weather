<?php

namespace Weather\Api;

use Weather\Model\Weather;

class DbDataRepository extends AbstractDb
{
    public function __construct()
    {
        $this->db = 'Data.json';
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
            $record->setDayTemp($item['dayTemp']);
            $record->setNightTemp($item['nightTemp']);
            $record->setSky($item['sky']);
            $result[] = $record;
        }

        return $result;
    }
}
