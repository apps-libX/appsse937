<?php
/**
 * fxserver3.ms.php
 * Created by anonymous on 21/04/16 2:45.
 */

include_once('fxpair3.ms.php');

header('Content-Type: text/event-stream');

$symbols = [
    new FXPair('EUR/USD', 1.3030, 0.0001, 5, 360, 47),
    new FXPair('EUR/USD', 1.3030, 0.0001, 5, 360, 47),
    new FXPair('USD/JPY', 95.10, 0.01, 3, 341, 55),
    new FXPair('AUD/GBP', 1.455, 0.0002, 5, 319, 39),
];

while (true) {
    $sleepSecs = mt_rand(250, 500) / 1000.0;

    usleep($sleepSecs * 1000000);

    $t  = microtime(true);
    $ix = mt_rand(0, count($symbols) - 1);
    $d  = $symbols[$ix]->generate($t);

    echo 'data:' . json_encode($d) . "\n\n";

    @ob_flush();
    @flush();
}
