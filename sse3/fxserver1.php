<?php
/**
 * fxserver1.php
 * Created by anonymous on 21/04/16 2:13.
 */

header('Content-Type: text/event-stream');

while (true) {

    $sleepSecs = mt_rand(250, 500) / 1000.0;

    usleep($sleepSecs * 1000000);

    $d = [
        'timestamp' => gmdate('Y-m-d H:i:s'),
        'symbol'    => 'GBP/USD',
        'bid'       => 1.203,
        'ask'       => 1.204,
    ];

    echo 'data:' . json_encode($d) . "\n\n";

    @ob_flush();
    @flush();
}