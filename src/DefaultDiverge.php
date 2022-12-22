<?php

namespace Se\Diverge;

class DefaultDiverge implements Diverge
{
    private float $maxDeviation;
    private float $deviation;

    /**
     * @param float $maxDeviation
     */
    public function __construct(float $maxDeviation = 0)
    {
        $this->maxDeviation = $maxDeviation;
        $this->deviation = 0;
    }

    /**
     * @inheritDoc
     */
    public function diffPrice(float $new, float $old): bool
    {
        if ($old === 0.0) {
            $this->deviation = PHP_FLOAT_MAX;
            return false;
        }

        if ($new !== 0.0) {
            $this->deviation = $new*100/$old;
        }

        if ($this->getDeviation() > $this->getMaxDeviation()) {
            return false;
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function getDeviation(): float
    {
        return $this->deviation;
    }

    /**
     * @param float $maxDeviation
     */
    public function setMaxDeviation(float $maxDeviation): void
    {
        $this->maxDeviation = $maxDeviation;
    }

    /**
     * @return float
     */
    public function getMaxDeviation(): float
    {
        return $this->maxDeviation;
    }

}
