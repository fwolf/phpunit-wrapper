<?php
namespace Fwolf\Wrapper\PHPUnit\Helper;

use PHPUnit_Framework_MockObject_Matcher_AnyInvokedCount as AnyInvokeCount;
use PHPUnit_Framework_MockObject_MockBuilder as MockBuilder;
use PHPUnit_Framework_MockObject_MockObject as MockObject;

/**
 * Trait for build simple mock which change method return value
 *
 * @method  MockBuilder getMockBuilder($className)
 * @method  static AnyInvokeCount  any()
 *
 * @copyright   Copyright 2015 Fwolf
 * @license     http://opensource.org/licenses/MIT MIT
 */
trait BuildEasyMockTrait
{
    /**
     * @param   string   $className
     * @param   string[] $methods {methodName: returnValue}
     * @return  MockObject|object
     */
    public function buildEasyMock($className, array $methods = [])
    {
        $mock = $this->getMockBuilder($className)
            ->setMethods(empty($methods) ? null : array_keys($methods))
            ->getMock();

        foreach ($methods as $method => $returnValue) {
            $mock->expects($this->any())
                ->method($method)
                ->willReturn($returnValue);
        }

        return $mock;
    }
}
