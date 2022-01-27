<?php

namespace App\Tests;

use App\Entity\Airport;
use App\Entity\Flight;
use Exception;
use PHPUnit\Framework\TestCase;

class FlightTest extends TestCase
{
    /**
     * @dataProvider flightsDataProvider
     */
    public function testFlightDuration($flight, $exptectedDuration)
    {
        $this->assertEquals($exptectedDuration, $flight->calculateDurationMinutes(), 'invalid flight duration');
    }

    /**
     * @throws Exception
     */
    private function flightsDataProvider(): array
    {
        return [
            [
                new Flight(
                    new Airport('DME', 'Домодедово', 'Москва', 'GMT+03'),
                    '2022-01-15',
                    '23:55',
                    new Airport('LED', 'Пулково', 'Санкт‑Петербург', 'GMT+03'),
                    '2022-01-16',
                    '01:35',
                ),
                100,
            ],
            [
                new Flight(
                    new Airport('LED', 'Пулково', 'Санкт‑Петербург', 'GMT+03'),
                    '2022-01-15',
                    '06:25',
                    new Airport('VKO', 'Внуково', 'Москва', 'GMT+03'),
                    '2022-01-15',
                    '07:50',
                ),
                85,
            ],
            [
                new Flight(
                    new Airport('OVB', 'Толмачёво', 'Новосибирск', 'GMT+07'),
                    '2022-01-15',
                    '08:50',
                    new Airport('LED', 'Пулково', 'Санкт‑Петербург', 'GMT+03'),
                    '2022-01-15',
                    '09:35',
                ),
                285,
            ],
            [
                new Flight(
                    new Airport('LAX', 'Лос‑Анджелес', 'Лос‑Анджелес', 'GMT-08'),
                    '2022-01-15',
                    '22:45',
                    new Airport('NAN', 'Нанди', 'Нанди', 'GMT+12'),
                    '2022-01-17',
                    '05:45',
                ),
                660,
            ],
        ];
    }
}
