<?php
/**
 * fxpair4.id.php
 * Created by anonymous on 09/05/16 22:20.
 */

class FXPair
{
    private $symbol;
    private $bid;
    private $spread;
    private $decimalPlaces;
    private $longCycle;
    private $shortCycle;

    public function __construct($symbol, $b, $s, $d, $c1, $c2)
    {
        $this->symbol        = $symbol;
        $this->bid           = $b;
        $this->spread        = $s;
        $this->decimalPlaces = $d;
        $this->longCycle     = $c1;
        $this->shortCycle    = $c2;
    }

    public function generate($t)
    {
        $bid = $this->bid;
        $bid += $this->spread * 100 * sin((360 / $this->longCycle) * (deg2rad($t % $this->longCycle)));
        $bid += $this->spread * 30 * sin((360 / $this->shortCycle) * (deg2rad($t % $this->shortCycle)));
        $bid += (mt_rand(-1000, 1000) / 1000.0) * 10 * $this->spread;
        $ask = $bid + $this->spread;

        $ms = (int)($t * 1000);
        $ts = gmdate("Y-m-d H:i:s", $t) . sprintf(".%03d", $ms % 1000);

        return [
            'symbol'    => $this->symbol,
            'timestamp' => $ts,
            'rows'      => [
                [
                    'id'        => $ms,
                    'timestamp' => $ts,
                    'bid'       => number_format($bid, $this->decimalPlaces),
                    'ask'       => number_format($ask, $this->decimalPlaces),
                ],
            ],
        ];
    }

}
