<?php

require 'vendor/autoload.php';

$app = new App(true);

// $app->add(new \atk4\login\Auth())
//     ->setModel(new \atk4\login\Model\User($app->db));
//

$app->add('CRUD')->setModel(new Model\User($app->db));
$app->add('CRUD')->setModel(new Model\Friend($app->db));
$app->add('CRUD')->setModel(new Model\Loan($app->db));
$app->add('CRUD')->setModel(new Model\Repayment($app->db));
