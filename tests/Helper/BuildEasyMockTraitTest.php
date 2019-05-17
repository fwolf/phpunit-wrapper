<?php

namespace FwolfTest\Wrapper\PHPUnit\Helper;

use Fwolf\Wrapper\PHPUnit\Helper\BuildEasyMockTrait;
use Fwolf\Wrapper\PHPUnit\TestCase;
use FwolfTest\Wrapper\PHPUnit\PHPUnitTestCaseTestDummy;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @copyright   Copyright 2015-2019 Fwolf
 * @license     http://opensource.org/licenses/MIT MIT
 */
class BuildEasyMockTraitTest extends TestCase
{
    /**
     * @param string[] $methods
     * @return  MockObject | BuildEasyMockTrait
     */
    protected function buildMock(array $methods = null)
    {
        $mock = $this->getMockBuilder(BuildEasyMockTrait::class)
            ->setMethods($methods)
            ->getMockForTrait()
        ;

        return $mock;
    }


    public function testBuildEasyMock()
    {
        $trait = $this->buildEasyMock(PHPUnitTestCaseTestDummy::class, [
            'publicMethod'   => 2019,
            'notExistMethod' => 'bar',
        ]);

        $this->assertEquals(2019, $trait->publicMethod());
        $this->assertEquals('bar', $trait->notExistMethod());


        // Empty method will got a workable mock
        $trait = $this->buildEasyMock(PHPUnitTestCaseTestDummy::class);

        $this->assertNotEmpty($trait->publicMethod());
    }


    public function testBuildEasyMockForAbstractClass()
    {
        $trait = $this->buildEasyMock(AbstractClassDummy::class, [
            'get' => 42,
        ]);

        $this->assertEquals(42, $trait->get());
    }


    public function testBuildEasyMockForTrait()
    {
        $trait = $this->buildEasyMock(BuildEasyMockTrait::class, [
            'get' => 42,
        ]);

        $this->assertEquals(42, $trait->get());
    }
}
