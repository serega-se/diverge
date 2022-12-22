<?php

namespace Se\Diverge;

interface Diverge
{
    /**
     * Отклонение цены не должно быть больше допустимого значения (%)
     *
     * @param float $new новая цена, которую будем проверять на отклонение.
     * @param float $old текущая цена.
     * @return bool
     */
    public function diffPrice(float $new, float $old): bool;

    /**
     * Результат отклонения в %
     *
     * @return float
     */
    public function getDeviation(): float;
}


