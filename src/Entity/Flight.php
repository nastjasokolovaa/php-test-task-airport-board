<?php

namespace App\Entity;

use DateTime;
use DateTimeZone;
use Exception;

class Flight
{
    private const DATE_TIME_FORMAT = 'Y-m-d H:i:sP';

    private Airport $fromAirport;
    private DateTime $fromTime;
    private Airport $toAirport;
    private DateTime $toTime;

    /**
     * @throws Exception
     */
    public function __construct(
        Airport $fromAirport,
        string  $fromDate,
        string  $fromTime,
        Airport $toAirport,
        string  $toDate,
        string  $toTime,
    )
    {
        $this->fromAirport = $fromAirport;
        $this->fromTime = self::getDateTime($fromDate, $fromTime, $fromAirport);
        $this->toAirport = $toAirport;
        $this->toTime = self::getDateTime($toDate, $toTime, $toAirport);;
    }

    /**
     * @throws Exception
     */
    private static function getDateTime(string $date, string $time, Airport $airport): DateTime
    {
        return new DateTime("$date $time", new DateTimeZone($airport->getTimeZone()));
    }

    public function getFromAirport(): Airport
    {
        return $this->fromAirport;
    }

    public function getFromTime(): string
    {
        return $this->fromTime->format(self::DATE_TIME_FORMAT);
    }

    public function getToAirport(): Airport
    {
        return $this->toAirport;
    }

    public function getToTime(): string
    {
        return $this->toTime->format(self::DATE_TIME_FORMAT);
    }

    public function calculateDurationMinutes(): int
    {
        return ($this->toTime->getTimestamp() - $this->fromTime->getTimestamp()) / 60;
    }
}