<?php

namespace App;

/**
 * Class Worker
 * @package App
 * 2var $salaryStrategy SalaryInterface
 */
class Worker extends AbstractModel
{
    protected static $table = 'workers';
    public $id;
    public $firstname;
    public $lastname;
    public $position;
    public $salary;
    protected $additionalSalary;
    public $photo;

    protected $salaryStrategy = UsualSalaryStrategy::class;
    protected $salaryStrategyParams = [];
    protected $connections = [
        [Profession::class, 'id', 'position', 'profession'],
        [Payment::class, 'worker', 'id', 'payments']
    ];
    protected $dbFields = [
        'firstname' => 'string',
        'lastname' => 'string',
        'position' => 'int',
        'salary' => 'float',
        'photo' => 'string',
    ];

    public function getSalaryByDate($date)
    {
        $workerId = $this->id;
        $result = Payment::find("worker = $workerId and date = '$date'");
        return (count($result) > 1) ? $result : $result[0];
    }

    /**
     * @return mixed
     */
    public function getAdditionalSalary($currencyCode = null)
    {
        if (!$this->additionalSalary) {
            $this->additionalSalary = $this->salaryStrategy::getSalary($this, $this->salaryStrategyParams);
        }
        if ($currencyCode) {
            static $currency;
            $currency = new Currency($currencyCode);
            $this->additionalSalary = $currency->transform($this->additionalSalary);

        }
        return $this->additionalSalary;
    }

    protected function afterFind()
    {
//        $this->salary = $this->salaryStrategy::getSalary($this, $this->salaryStrategyParams);
    }

    public function appendImage($postFiles)
    {
        if ($postFiles['photo']) {
            $fileSrc = $postFiles['photo']['tmp_name'];
            $ext = explode('.', $postFiles['photo']['name']);
            $ext = $ext[sizeof($ext) - 1];
            if (@is_array(getimagesize($fileSrc))) {
                $generatedFilename = uniqid();
                $filename = $generatedFilename . '.' . $ext;
                $filenameCropSrc = $_SERVER['DOCUMENT_ROOT'] . '/img/upload/' . $generatedFilename . '_min.' . $ext;
                $fileNewSrc = $_SERVER['DOCUMENT_ROOT'] . '/img/upload/' . $filename;
                copy($fileSrc, $fileNewSrc);
                Image::makeThumb($fileNewSrc, $filenameCropSrc, 300);
                $this->photo = '/img/upload/' . $filename;
            }
        }
    }

    public function setSalaryStrategy($strategy, $params)
    {
        $this->salaryStrategy = $strategy;
        $this->salaryStrategyParams = $params;
    }
}