<?php

namespace App;

interface SalaryInterface
{
    public static function getSalary(Worker $worker, array $params);
}