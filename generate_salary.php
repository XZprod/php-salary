<?php

require __DIR__ . '/vendor/autoload.php';

const WORKERS = 15;

use App\ServiceLocator;

/** @var ServiceLocator $serviceLocator */
$serviceLocator = ServiceLocator::getInstance();

/** @var \App\DB $db */
$db = $serviceLocator::getService('db');
$currDate = new DateTime();
$date = new DateTime();
$date->sub((new DateInterval('P1Y')));

while ($currDate->format('U') > $date->format('U')) {
    $query = 'INSERT INTO payment(worker, date, salary) VALUES ';
    $values = [];
    for ($i = 1; $i <= WORKERS; $i++) {
        $salary = rand(10000, 130000);
        $outputDate = $date->format('Y-m-d');
        $values[] = "($i, '$outputDate', $salary)";
    }
    $query .= implode(',', $values) . ';';
    $db->exec($query);
    $date->add((new DateInterval('P1M')));
}