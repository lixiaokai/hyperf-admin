<?php

namespace HyperfTest\Cases;

use Kernel\Exception\BusinessException;
use Kernel\Exception\DataSaveException;
use Kernel\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

/**
 * 异常 - 单元测试.
 */
class ExceptionTest extends TestCase
{
    /**
     * 测试- 业务异常.
     */
    public function testBizException()
    {
        try {
            throw new BusinessException();
        } catch (BusinessException $e) {
            self::assertEquals(400, $e->getCode());
            self::assertEquals('业务异常', $e->getMessage());
        }
    }

    /**
     * 测试- 资源不存在异常.
     */
    public function testNotFoundException()
    {
        try {
            throw new NotFoundException();
        } catch (NotFoundException $e) {
            self::assertEquals(404, $e->getCode());
            self::assertEquals('资源不存在', $e->getMessage());
        }
    }

    /**
     * 测试- 数据保存异常.
     */
    public function testDataSaveException()
    {
        try {
            throw new DataSaveException();
        } catch (DataSaveException $e) {
            self::assertEquals(500, $e->getCode());
            self::assertEquals('数据保存异常', $e->getMessage());
        }
    }
}
