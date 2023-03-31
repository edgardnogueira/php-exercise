<?php

use AsciiArrayExercise\Services\RandomAsciiArray;
use PHPUnit\Framework\TestCase;

class RandomAsciiArrayTest extends TestCase
{
    public function testRandomAsciiArray()
    {
        $randomArray = new RandomAsciiArray('A', 'E');
        $expectedArray = ['A', 'B', 'C', 'D', 'E'];
        $generatedArray = $randomArray->generate();
        
        $this->assertEmpty(array_diff($generatedArray, $expectedArray));
        $this->assertEquals(count($generatedArray), 5);
        $this->assertContains('A', $generatedArray);
        $this->assertNotContains('F', $generatedArray);
    }
}
