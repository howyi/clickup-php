<?php
namespace ClickUp;

require_once __DIR__ . '/vendor/autoload.php';

echo __NAMESPACE__ . " shell\n";

$sh = new \Psy\Shell();

$sh->addCode(sprintf("namespace %s;", __NAMESPACE__));

$sh->run();