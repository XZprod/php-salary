<?php

require __DIR__ . '/global_utils.php';
require __DIR__ . '/vendor/autoload.php';

$action = $_GET['action'];

if ($action == '') {
    $workers = \App\Worker::find();
    $currency = $_GET['currency'];
    $date = $_GET['date'];
    if ($date) {
        /** @var \App\Worker $worker */
        foreach ($workers as $worker) {
            $worker->setSalaryStrategy(\App\GotSalaryStrategy::class, ['date' => $date]);
//            $worker->addCondToConnection('payments', "date = '$date'");
        }
    }
    require './view/index.php';
    exit;
}

if ($action == 'new-worker') {
    if ($_POST) {
        $worker = new App\Worker($_POST);
        $worker->appendImage($_FILES);
        $worker->save();
        http_redirect('/');
    } else {
        require './view/new_worker.php';
    }
}

