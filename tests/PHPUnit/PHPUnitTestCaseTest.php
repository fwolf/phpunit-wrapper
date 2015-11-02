<?php
namespace FwolfTest\Wrapper\PHPUnit;

use Fwolf\Wrapper\PHPUnit\PHPUnitTestCase;
use PHPUnit_Framework_ExpectationFailedException as ExpectationFailedException;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * @copyright   Copyright 2015 Fwolf
 * @license     http://opensource.org/licenses/MIT MIT
 */
class PHPUnitTestCaseTest extends PHPUnitTestCase
{
    /**
     * @return MockObject|PHPUnitTestCase
     */
    protected function buildMock()
    {
        $mock = $this->getMock(
            PHPUnitTestCase::class,
            null
        );

        return $mock;
    }


    /**
     * Assoc with different key sequence is equal by default
     */
    public function testAssertEqualArray()
    {
        $testCase = $this->buildMock();

        $ar1 = [
            'foo' => 1,
            'bar' => 2,
        ];
        $ar2 = [
            'bar' => 2,
            'foo' => 1,
        ];
        $testCase->assertEquals($ar1, $ar2);

        $testCase->assertEqualArray($ar1, $ar1);
    }


    public function testAssertEqualArrayWithDifferentSequence()
    {
        $testCase = $this->buildMock();

        $ar1 = [
            'foo' => 1,
            'bar' => 2,
        ];
        $ar2 = [
            'bar' => 2,
            'foo' => 1,
        ];
        try {
            $testCase->assertEqualArray($ar1, $ar2);

            // No error caught means test fail
            $this->assertTrue(false);

        } catch (ExpectationFailedException $e) {
            // Caught exception means 2 array are not equal
            $this->assertTrue(true);
        }
    }


    public function testReflectionMethods()
    {
        $testCase = $this->buildMock();
        $dummy = new PHPUnitTestCaseTestDummy();

        $this->assertEquals(
            1,
            $testCase->reflectionGet($dummy, 'privateProperty')
        );

        $this->assertEquals(3, $dummy->publicMethod());
        $this->assertEquals(
            3,
            $testCase->reflectionCall($dummy, 'privateMethod')
        );

        $testCase->reflectionSet($dummy, 'privateProperty', 20);
        $testCase->reflectionSet($dummy, 'privateStaticProperty', 22);
        $this->assertEquals(42, $dummy->publicMethod());
    }
}
