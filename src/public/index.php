<?php

require '../bootstrap.php';
require '../MiniBlogApplication.php';

// TODO: 引数ホントはfalseにしたいけどデバック用でtrueにしてる
$app = new MiniBlogApplication(true);
$app->run();
