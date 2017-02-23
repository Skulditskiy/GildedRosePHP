<?php

namespace GildedRose\Tests;

use GildedRose\Item;
use GildedRose\ItemConjurable;
use GildedRose\Program;

class GildedRoseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
	public function testUpdateQuality_emptyItem()
	{
	    // prepare
		$item = new Item([]);
		$program = new Program([]);

        // test
		$resultItem = $program->updateQuality($item);
        $expectedResult = new Item([]);

        // verify
		$this->assertEquals($expectedResult, $resultItem);
    }

    /**
     * @test
     */
    public function testUpdateQuality_simpleItemQualityDecreaseBy1()
    {
        // prepare
        $item = new Item([
            'name' => 'someName',
            'sellIn' => 11,
            'quality' => 19
        ]);
        $expectedResult = 18;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_simpleItemSellInDecreaseBy1()
    {
        // prepare
        $item = new Item([
            'name' => 'someName',
            'sellIn' => 11,
            'quality' => 19
        ]);
        $expectedResult = 10;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->sellIn;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_simpleItemQualityAlwaysMoreThanZero()
    {
        // prepare
        $item = new Item([
            'name' => 'someName',
            'sellIn' => 11,
            'quality' => 0
        ]);
        $expectedResult = 0;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_conjuredSimpleItem()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'someName',
            'sellIn' => 11,
            'quality' => 12,
            'conjured' => true
        ]);
        $expectedResult = 10;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_conjuredSimpleItemAfterSellIn()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'someName',
            'sellIn' => 0,
            'quality' => 12,
            'conjured' => true
        ]);
        $expectedResult = 8;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_sulfurusSellIn()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Sulfuras, Hand of Ragnaros',
            'sellIn' => 123,
            'quality' => 80,
            'conjured' => true
        ]);
        $expectedResult = 123;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->sellIn;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_sulfurusQuality()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Sulfuras, Hand of Ragnaros',
            'sellIn' => 123,
            'quality' => 70,
            'conjured' => true
        ]);
        $expectedResult = 71;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_sulfurusMaxQuality()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Sulfuras, Hand of Ragnaros',
            'sellIn' => 123,
            'quality' => 80,
            'conjured' => true
        ]);
        $expectedResult = 80;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_agedBrieNormal()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Aged Brie',
            'sellIn' => 123,
            'quality' => 40,
        ]);
        $expectedResult = 41;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_agedBrieAfterSellInDate()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Aged Brie',
            'sellIn' => 0,
            'quality' => 40,
        ]);
        $expectedResult = 42;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_agedBrieMaxQuality()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Aged Brie',
            'sellIn' => 0,
            'quality' => 49,
        ]);
        $expectedResult = 50;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_backstagePassesNormal()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Backstage passes to a TAFKAL80ETC concert',
            'sellIn' => 29,
            'quality' => 20,
        ]);
        $expectedResult = 21;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_backstagePassesLessThan11Days()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Backstage passes to a TAFKAL80ETC concert',
            'sellIn' => 9,
            'quality' => 20,
        ]);
        $expectedResult = 22;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_backstagePassesLessThan6Days()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Backstage passes to a TAFKAL80ETC concert',
            'sellIn' => 5,
            'quality' => 20,
        ]);
        $expectedResult = 23;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_backstagePassesMaxQuality()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Backstage passes to a TAFKAL80ETC concert',
            'sellIn' => 5,
            'quality' => 49,
        ]);
        $expectedResult = 50;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_backstagePassesAfterSellIn()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Backstage passes to a TAFKAL80ETC concert',
            'sellIn' => 0,
            'quality' => 49,
        ]);
        $expectedResult = 0;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->quality;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateQuality_backstageNormalSellIn()
    {
        // prepare
        $item = new ItemConjurable([
            'name' => 'Backstage passes to a TAFKAL80ETC concert',
            'sellIn' => 12,
            'quality' => 49,
        ]);
        $expectedResult = 11;
        $program = new Program([]);

        // test
        $resultItem = $program->updateQuality($item);
        $result = $resultItem->sellIn;

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateAllQuality_noItems()
    {
        // prepare
        $program = new Program([]);
        $expectedResult = [];

        // test
        $result = $program->updateAllQuality([]);

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateAllQuality_withItem()
    {
        // prepare
        /** @var Program|\PHPUnit_Framework_MockObject_MockObject $programMock */
        $programMock = $this->getMockBuilder(Program::class)
            ->setMethods(['updateQuality'])
            ->disableOriginalConstructor()
            ->getMock();
        $expectedResult = ['someResult'];
        $programMock->expects($this->once())
            ->method('updateQuality')
            ->willReturn('someResult');
        $item = new Item([]);

        // test
        $result = $programMock->updateAllQuality([$item]);

        // verify
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @test
     */
    public function testUpdateAllQuality_withItems()
    {
        // prepare
        /** @var Program|\PHPUnit_Framework_MockObject_MockObject $programMock */
        $programMock = $this->getMockBuilder(Program::class)
            ->setMethods(['updateQuality'])
            ->disableOriginalConstructor()
            ->getMock();
        $expectedResult = ['someResult0','someResult1','someResult2'];
        $programMock->expects($this->at(0))
            ->method('updateQuality')
            ->willReturn('someResult0');
        $programMock->expects($this->at(1))
            ->method('updateQuality')
            ->willReturn('someResult1');
        $programMock->expects($this->at(2))
            ->method('updateQuality')
            ->willReturn('someResult2');
        $item = new Item([]);

        // test
        $result = $programMock->updateAllQuality([$item, clone($item), clone($item)]);

        // verify
        $this->assertEquals($expectedResult, $result);
    }



}

