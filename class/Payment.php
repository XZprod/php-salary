<?php

namespace App;

class Payment extends AbstractModel
{
    protected static $table = 'payment';
    public $id;
    public $worker;
    public $date;
    public $salary;

}