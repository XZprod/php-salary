<?php

namespace App;

class GotSalaryStrategy implements SalaryInterface
{
    public static function getSalary(Worker $worker, array $params)
    {
        $date = $params['date'] ?? date('Y-m-d');
        return $worker->getSalaryByDate($date)->salary;
    }
}