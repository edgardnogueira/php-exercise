<?php

use AbTestingExercise\Services\ABTest;
use AbTestingExercise\Services\DefaultCalcAB;
use AbTestingExercise\Services\DefaultRedirector;
use AbTestingExercise\Services\SessionCache;
use Exads\ABTestData;
use PHPUnit\Framework\TestCase;

class ABTestTest extends TestCase
{
    protected $promoId;

    // set up promo id
    public function setUp(): void
    {
        $this->promoId = 1;
    }

    public function testPromoIdThatDoesnExist()
    {
        $calcAB = new DefaultCalcAB();
        $redirector = new DefaultRedirector();
        $cache = new SessionCache();

        // check throw exception
        $this->expectException(\App\Exceptions\DefaultException::class);
        (new ABTest(4, $calcAB, $redirector, $cache));
    }

    public function testRunPromotionWithoutDesigns()
    {
        $abTestData = $this->createMock(ABTestData::class);
        $sampleDesigns = [];

        $abTestData->method('getAllDesigns')->willReturn($sampleDesigns);

        $calcAB = new DefaultCalcAB();
        $redirector = new DefaultRedirector();
        $cache = new SessionCache();

        $abTest = new ABTest($this->promoId, $calcAB, $redirector, $cache, $abTestData);

        $this->assertNull($abTest->run(), 'Expected null when no designs are provided');
    }

    public function testIfThereIsOneDesignReturnIt()
    {
        $abTestData = $this->createMock(ABTestData::class);
        $sampleDesigns = [
            ['splitPercent' => 30, 'designId' => 1],
        ];

        $abTestData->method('getAllDesigns')->willReturn($sampleDesigns);

        $calcAB = new DefaultCalcAB();
        $redirector = new DefaultRedirector();
        $cache = new SessionCache();

        $abTest = new ABTest($this->promoId, $calcAB, $redirector, $cache, $abTestData);

        $result = $abTest->run();

        $this->assertEquals($result, $redirector->redirectToOption($sampleDesigns[0]), 'Expected return the only design');
    }

    public function testDesignSelectedIfMoreRecords()
    {
        $abTestData = $this->createMock(ABTestData::class);
        $sampleDesigns = [
            ['splitPercent' => 30, 'designId' => 1],
            ['splitPercent' => 40, 'designId' => 2],
            ['splitPercent' => 15, 'designId' => 3],
            ['splitPercent' => 15, 'designId' => 4],
        ];

        $abTestData->method('getAllDesigns')->willReturn($sampleDesigns);

        $calcAB = new DefaultCalcAB();
        $redirector = new DefaultRedirector();
        $cache = new SessionCache();

        $abTest = new ABTest($this->promoId, $calcAB, $redirector, $cache, $abTestData);

        $result = $abTest->run();

        $this->assertNotNull($result, 'Expected a design to be selected');
    }

    public function testSameDesignWithSecondUserAccess()
    {
        $abTestData = $this->createMock(ABTestData::class);

        $sampleDesigns = [
            ['splitPercent' => 35, 'designId' => 1],
            ['splitPercent' => 5, 'designId' => 2],
            ['splitPercent' => 30, 'designId' => 3],
            ['splitPercent' => 30, 'designId' => 4],
        ];

        $abTestData->method('getAllDesigns')->willReturn($sampleDesigns);

        $abTestData->method('getPromotionName')->willReturn('test');

        // mock the session Cache
        $cache = $this->createMock(SessionCache::class);

        $fakeSessionKey = 'test_'.$this->promoId;

        $cache->method('get')
            ->with($fakeSessionKey)
            ->willReturn($sampleDesigns[1]);

        $cache->method('has')
        ->with($fakeSessionKey)
        ->willReturn(true);

        $calcAB = new DefaultCalcAB();
        $redirector = new DefaultRedirector();

        $abTest = new ABTest($this->promoId, $calcAB, $redirector, $cache, $abTestData);

        $result = $abTest->run();

        $this->assertEquals($result, $redirector->redirectToOption($sampleDesigns[1], true), 'Expected always return same design');
    }
}
