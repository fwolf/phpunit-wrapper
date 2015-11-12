<?php
namespace FwolfTest\Wrapper\PHPUnit\Helper;

use Fwolf\Wrapper\PHPUnit\Helper\BuildEasyMockTrait;
use Fwolf\Wrapper\PHPUnit\PHPUnitTestCase;
use FwolfTest\Wrapper\PHPUnit\PHPUnitTestCaseTestDummy;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @copyright   Copyright 2015 Fwolf
 * @license     http://opensource.org/licenses/MIT MIT
 */
class BuildEasyMockTraitTest extends PHPUnitTestCase
{
    /**
     * @param   string[] $methods
     * @return  MockObject|BuildEasyMockTrait
     */
    protected function buildMock(array $methods = null)
    {
        $mock = $this->getMockBuilder(BuildEasyMockTrait::class)
            ->setMethods($methods)
            ->getMock();

        return $mock;
    }


    public function testBuildEasyMock()
    {
        $trait = $this->buildEasyMock(PHPUnitTestCaseTestDummy::class, [
            'publicMethod'   => 'foo',
            'notExistMethod' => 'bar',
        ]);

        $this->assertEquals('foo', $trait->publicMethod());
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
