#! /usr/bin/env php

<?php

require __DIR__ ."/vendor/autoload.php";

use Acme\Console\Command\HelloWorldCommand;
use Symfony\Component\Console\Application;

$command = new HelloWorldCommand();
$application = new Application();
$application->add($command);
$application->setDefaultCommand($command->getName());
$application->run();