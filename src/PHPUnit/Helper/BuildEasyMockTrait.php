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
        $builder = $this->getMockBuilder($className)
            ->setMethods(empty($methods) ? null : array_keys($methods));

        // Use class name without namespace path to detect abstract or trait
        $shortName = join('', array_slice(explode('\\', $className), -1));
        if ('Trait' == substr($shortName, -5)) {
            $mock = $builder->getMockForTrait();
        } elseif ('Abstract' == substr($shortName, 0, 8)) {
            $mock = $builder->getMockForAbstractClass();
        } else {
            $mock = $builder->getMock();
        }

        foreach ($methods as $method => $returnValue) {
            $mock->expects($this->any())
                ->method($method)
                ->willReturn($returnValue);
        }

        return $mock;
    }
}
