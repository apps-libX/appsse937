<?php
/**
 * fxpair.seconds.php
 * Created by anonymous on 21/04/16 2:13.
 */

/**
 * Class FXPair
 */
class FXPair
{
    /**
     * @var
     */
    private $symbol;

    /**
     * @var
     */
    private $bid;

    /**
     * @var
     */
    private $spread;

    /**
     * @var
     */
    private $decimalPlaces;

    /**
     * @var
     */
    private $longCycle;

    /**
     * @var
     */
    private $shortCycle;

    /**
     * @param $symbol
     * @param $b
     * @param $s
     * @param $d
     * @param $c1
     * @param $c2
     */
    public function __construct($symbol, $b, $s, $d, $c1, $c2)
    {
        $this->symbol        = $symbol;
        $this->bid           = $b;
        $this->spread        = $s;
        $this->decimalPlaces = $d;
        $this->longCycle     = $c1;
        $this->shortCycle    = $c2;
    }

    /**
     * @param $t
     * @return array
     */
    public function generate($t)
    {
        $bid = $this->bid;
        $bid += $this->spread * 100 * sin((360 / $this->longCycle) * (deg2rad($t % $this->longCycle)));
        $bid += $this->spread * 30 * sin((360 / $this->shortCycle) * (deg2rad($t % $this->shortCycle)));
        $bid += (mt_rand(-1000, 1000) / 1000.0) * 10 * $this->spread;
        $ask = $bid + $this->spread;

        return [
            'timestamp' => gmdate('Y-m-d H:i:s', $t),
            'symbol'    => $this->symbol,
            'bid'       => number_format($bid, $this->decimalPlaces),
            'ask'       => number_format($ask, $this->decimalPlaces),
        ];
    }

}