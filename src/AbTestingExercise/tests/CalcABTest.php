<?php

use AbTestingExercise\Services\DefaultCalcAB;
use PHPUnit\Framework\TestCase;

class CalcABTest extends TestCase
{
    public function testCalculateWeight()
    {
        $sampleDesigns = [
            ['splitPercent' => 30, 'designId' => 1],
            ['splitPercent' => 40, 'designId' => 2],
            ['splitPercent' => 15, 'designId' => 3],
            ['splitPercent' => 15, 'designId' => 4],
        ];

        $calcAB = new DefaultCalcAB();

        $result = $calcAB->run($sampleDesigns);

        $cumulativeWeightsArray = $calcAB->getCumulativeWeights();

        $this->assertEquals(end($cumulativeWeightsArray), 100, 'Expected last weight to be 100');

        $this->assertEquals($cumulativeWeightsArray[0], 30, 'Expected first weight to be 30');
        $this->assertEquals($cumulativeWeightsArray[1], 70, 'Expected second weight to be 70');
        $this->assertEquals($cumulativeWeightsArray[2], 85, 'Expected third weight to be 85');
        $this->assertEquals($cumulativeWeightsArray[3], 100, 'Expected fourth weight to be 100');

        $this->assertEquals(count($calcAB->getCumulativeWeights()), count($sampleDesigns), 'Expected the same number of weights as designs');
    }

    public function testCalcABReturnExceptionIfWrongSplitTestWeight()
    {
        $sampleDesigns = [
            ['splitPercent' => 30, 'designId' => 1],
            ['splitPercent' => 40, 'designId' => 2],
            ['splitPercent' => 15, 'designId' => 3],
        ];

        $calcAB = new DefaultCalcAB();

        $this->expectException(\Exception::class);

        $result = $calcAB->run($sampleDesigns);

        $cumulativeWeightsArray = $calcAB->getCumulativeWeights();
    }

    public function testCalculateWithoutDesignsReturnEmpty()
    {
        $sampleDesigns = [

        ];

        $calcAB = new DefaultCalcAB();

        $result = $calcAB->run($sampleDesigns);

        $this->assertEmpty($result, 'Expected empty array when no designs are provided');
    }

    public function testSelectExistingDesign()
    {
        $sampleDesigns = [
            ['splitPercent' => 30, 'designId' => 1],
            ['splitPercent' => 40, 'designId' => 2],
            ['splitPercent' => 15, 'designId' => 3],
            ['splitPercent' => 15, 'designId' => 4],
        ];

        $calcAB = new DefaultCalcAB();

        $result = $calcAB->run($sampleDesigns);

        $selectedItem = $calcAB->selectItemByWeight($result);

        $this->assertContains($result, $sampleDesigns, 'Expected the selected design to be in the sample designs');
    }
}
