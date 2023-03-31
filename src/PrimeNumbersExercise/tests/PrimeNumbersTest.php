<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PrimeNumbersExercise\Services\FactorsGenerator;
use PrimeNumbersExercise\Services\NumbersGenerator;
use PrimeNumbersExercise\Services\PrimeChecker;

class PrimeNumbersTest extends TestCase
{
    public function testIsPrime()
    {
        $primeChecker = new PrimeChecker();

        $this->assertFalse($primeChecker(1));
        $this->assertTrue($primeChecker(2));
        $this->assertTrue($primeChecker(3));
        $this->assertFalse($primeChecker(4));
        $this->assertTrue($primeChecker(5));
    }

    public function testGetFactors()
    {
        $factorsGenerator = new FactorsGenerator();

        $this->assertEquals([1], $factorsGenerator(1));
        $this->assertEquals([1, 2], $factorsGenerator(2));
        $this->assertEquals([1, 3], $factorsGenerator(3));
        $this->assertEquals([1, 2, 4], $factorsGenerator(4));
    }

    public function testGenerate()
    {
        $output = '1[1]2[Prime]3[Prime]4[1,2,4]';
        
        $numbers = new NumbersGenerator(new PrimeChecker(), new FactorsGenerator());
        $this->assertEquals($output, $numbers(1, 4));
    }
}
