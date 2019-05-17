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


    /**
     * @return int
     */
    private function privateMethod()
    {
        return $this->privateProperty + self::$privateStaticProperty;
    }


    /**
     * @return int
     */
    public function publicMethod()
    {
        return $this->privateMethod();
    }
}
