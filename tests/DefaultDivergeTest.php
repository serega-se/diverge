<?php

use PHPUnit\Framework\TestCase;
use Se\Diverge\DefaultDiverge;

class DefaultDivergeTest extends TestCase
{
    /**
     * Начальная цена: 20, конечная цена: 10
     * Допустимое отклонение: 0 не больше чем разница цен в процентах: 200
     * diffPrice должно вернуть false
     */
    public function testCreateDefaultDivergeMoreThenMin() : void
    {
        $diverge = new DefaultDiverge();
        $diffPrice = $diverge->diffPrice(20, 10);

        $this->assertFalse($diffPrice);
    }

    /**
     * Начальная цена: 10, конечная цена: 20
     * Допустимое отклонение: 300 больше чем разница цен в процентах: 200
     * diffPrice - true
     */
    public function testCreateDefaultDivergeLessThenMin() : void
    {
        $diverge = new DefaultDiverge(300);
        $diffPrice = $diverge->diffPrice(20, 10);

        $this->assertTrue($diffPrice);
    }

    /**
     * Начальная цена: 10, конечная цена: 20
     * Допустимое отклонение: -100 не больше разнице цен в процентах: 200
     * diffPrice - false
     */
    public function testCreateDefaultDivergeLessThenMinNegative() : void
    {
        $diverge = new DefaultDiverge(-100);
        $diffPrice = $diverge->diffPrice(20, 10);

        $this->assertFalse($diffPrice);
    }

    /**
     * Начальная цена: 0, конечная цена: 20
     * Допустимое отклонение: 0 не больше разнице цен в процентах: бесконечность ( деление на 0)
     * diffPrice - false
     */
    public function testCreateDefaultDivergeOldPriceNull() : void
    {
        $diverge = new DefaultDiverge();
        $diffPrice = $diverge->diffPrice(20, 0);

        $this->assertFalse($diffPrice);
    }

    /**
     * Начальная цена: 10, конечная цена: 0
     * Допустимое отклонение: 0 не больше разнице цен в процентах: 0 (деление 0 на любое число = 0)
     * diffPrice - true
     */
    public function testCreateDefaultDivergeNewPriceNull() : void
    {
        $diverge = new DefaultDiverge();
        $diffPrice = $diverge->diffPrice(0, 10);

        $this->assertTrue($diffPrice);
    }

    /**
     * Начальная цена: 0, конечная цена: 0
     * Допустимое отклонение: 0 не больше разнице цен в процентах: бесконечность (деление на 0)
     * diffPrice - false
     */
    public function testCreateDefaultDivergeAllPriceNull() : void
    {
        $diverge = new DefaultDiverge();
        $diffPrice = $diverge->diffPrice(0, 0);

        $this->assertFalse($diffPrice);
    }

    /**
     * Начальная цена: 20, конечная цена: -10
     * Допустимое отклонение: 0 больше разнице цен в процентах: -50
     * diffPrice - true
     */
    public function testCreateDefaultDivergeNewPriceNegative() : void
    {
        $diverge = new DefaultDiverge();
        $diffPrice = $diverge->diffPrice(-10, 20);

        $this->assertTrue($diffPrice);
    }


    /**
     * Начальная цена: -10, конечная цена: 20
     * Допустимое отклонение: 0 больше разнице цен в процентах: -200
     * diffPrice - true
     */
    public function testCreateDefaultDivergeOldPriceNegative() : void
    {
        $diverge = new DefaultDiverge();
        $diffPrice = $diverge->diffPrice(20, -10);

        $this->assertTrue($diffPrice);
    }

}
