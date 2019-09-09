<?php

namespace App;

class UsualSalaryStrategy implements SalaryInterface
{
    public static function getSalary(Worker $worker, array $params = [])
    {
        return $worker->salary;
    }
}