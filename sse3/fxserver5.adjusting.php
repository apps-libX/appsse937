<?php
/**
 * fxserver5.adjusting.php
 * Created by anonymous on 27/04/16 23:21.
 */

include_once('fxpair5.ms.php');

header("Content-Type: text/event-stream");

$symbols = [
    new FXPair('EUR/USD', 1.3030, 0.0001, 5, 360, 47),
    new FXPair('EUR/USD', 1.3030, 0.0001, 5, 360, 47),
    new FXPair('USD/JPY', 95.10, 0.01, 3, 341, 55),
    new FXPair('AUD/GBP', 1.455, 0.0002, 5, 319, 39),
];

$clock = microtime(true);

if (isset($argc) && $argc >= 2) {
    $t = $argv[1];
} elseif (array_key_exists('seed', $_REQUEST)) {
    $t = $_REQUEST['seed'];
} else {
    $t = $clock;

    echo "data:{\"seed\":$t}\n\n";
}

mt_srand($t * 1000);

while (true) {
    $sleepSecs  = mt_rand(250, 500) / 1000.0;
    $now        = microtime(true);
    $adjustment = $now - $clock;

    usleep(($sleepSecs - $adjustment) * 1000000);

    $t += $sleepSecs;
    $clock += $sleepSecs;

    $ix = mt_rand(0, count($symbols) - 1);
    $d  = $symbols[$ix]->generate($t);

    echo 'data:' . json_encode($d) . '\n\n';

    @ob_flush();
    @flush();
}
