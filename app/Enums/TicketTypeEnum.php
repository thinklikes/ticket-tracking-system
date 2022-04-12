<?php

namespace App\Enums;

use ReflectionClass;

class TicketTypeEnum
{
    const BUG = 1;
    const FEATURE_REQUEST = 2;
    const TEST_CASE = 3;

    const MAP = [
        self::BUG             => ['name' => 'BUG'],
        self::FEATURE_REQUEST => ['name' => 'FEATURE_REQUEST'],
        self::TEST_CASE       => ['name' => 'TEST_CASE'],
    ];

    const MAP_FOR_EDITING_BY_QA = [
        self::BUG             => ['name' => 'BUG'],
        self::TEST_CASE       => ['name' => 'TEST_CASE'],
    ];

    const MAP_FOR_EDITING_BY_PM = [
        self::FEATURE_REQUEST => ['name' => 'FEATURE_REQUEST'],
    ];

    const MAP_FOR_RESOLVING_BY_RD = [
        self::BUG             => ['name' => 'BUG'],
        self::FEATURE_REQUEST => ['name' => 'FEATURE_REQUEST'],
    ];
}
