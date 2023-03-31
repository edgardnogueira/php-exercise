<?php

use AsciiArrayExercise\Services\RandomAsciiArray;
use AsciiArrayExercise\Services\RandomRemoveItemArray;
use PHPUnit\Framework\TestCase;

class RandomRemoveItemTest extends TestCase
{
    public function testRemoveRandomItemNull()
    {
        $array = null;
        $this->expectException(TypeError::class);
        $randomArray = new RandomRemoveItemArray($array);
    }

    public function testRemoveRandomItem()
    {
        $generator = new RandomAsciiArray(',', '|');
        $randomAsciiArray = $generator->generate();
        $initialArray = $randomAsciiArray;
        $initialCount = count($randomAsciiArray);

        $randomArray = new RandomRemoveItemArray($randomAsciiArray);
        $randomArray->run();

        $afterRemoveArray = $randomAsciiArray;

        // Double check using array_diff
        $diffArray = array_diff($initialArray, $afterRemoveArray);
        $firstValueOfDiff = reset($diffArray);

        $this->assertEquals($randomArray->getRemovedItem(), $firstValueOfDiff);
        $this->assertEquals($initialCount - 1, count($randomAsciiArray));
        $this->assertNotNull($randomArray->getRemovedItem());
        $this->assertNotContains($randomArray->getRemovedItem(), $randomAsciiArray);
    }
}
