<?php

declare(strict_types=1);

namespace HyperfTest\Cases;

use Kernel\Model\BaseModel;
use PHPUnit\Framework\TestCase;

/**
 * 模型 - 单元测试.
 *
 * @internal
 * @coversNothing
 */
class ModelTest extends TestCase
{
    /**
     * 测试 - 获取带限定表名的字段.
     */
    public function testQualifyColumn()
    {
        $model = new class() extends BaseModel {
            protected $connection = 'default';
            protected $table = 'user';
        };

        self::assertSame('user.id', $model->qualifyColumn('id'));
        self::assertSame('user.id', $model::column('id'));
        self::assertSame('base.user.id', $model::column('id', true));
    }
}
