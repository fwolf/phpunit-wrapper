<?php

namespace FwolfTest\Wrapper\PHPUnit;

/**
 * PHPUnitTestCaseTestDummy
 */
class PHPUnitTestCaseTestDummy
{
    /** @type int $p */
    private $privateProperty = 1;

    /** @type int $p2 */
    private static $privateStaticProperty = 2;


    private function privateMethod(): int
    {
        return $this->privateProperty + self::$privateStaticProperty;
    }


    public function publicMethod(): int
    {
        return $this->privateMethod();
    }
}
