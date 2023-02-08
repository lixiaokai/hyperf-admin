<?php

declare(strict_types=1);

namespace Core\Repository;

use Core\Model\Attachment;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Model;

/**
 * 附件 - 仓库类.
 *
 * @method Attachment              getById(int $id)
 * @method Collection|Attachment[] getByIds(array $ids, array $columns = ['*'])
 * @method Attachment              create(array $data)
 * @method Attachment              update(Attachment $model, array $data)
 */
class AttachmentRepository extends BaseRepository
{
    protected string $modelClass = Attachment::class;

    /**
     * @return Attachment
     */
    public function getByHash(string $hash): ?Model
    {
        return $this->getQuery()->where(['hash' => $hash])->first();
    }
}
