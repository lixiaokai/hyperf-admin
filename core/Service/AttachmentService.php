<?php

namespace Core\Service;

use Core\Constants\ContextKey;
use Core\Model\Attachment;
use Core\Repository\AttachmentRepository;
use Hyperf\Context\Context;
use Hyperf\Contract\PaginatorInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Upload\UploadedFile;
use Kernel\Exception\BusinessException;

/**
 * 附件 - 服务类.
 */
class AttachmentService extends BaseService
{
    /** @Inject */
    protected AttachmentRepository $repo;

    /**
     * 附件 - 列表 ( 含筛选 ).
     */
    public function search(array $searchParams = []): PaginatorInterface
    {
        $query = $this->repo->getQuery()->orderBy('id');

        return $this->repo->search($searchParams, $query);
    }

    /**
     * 附件 - 详情.
     */
    public function get(int $id): Attachment
    {
        try {
            $attachment = $this->repo->getById($id);
        } catch (BusinessException $e) {
            throw new BusinessException('该附件不存在');
        }

        return $attachment;
    }

    public function getByHash(string $hash, bool $isThrowException = true): ?Attachment
    {
        $attachment = $this->repo->getByHash($hash);

        if ($isThrowException && $attachment === null) {
            throw new BusinessException('该附件不存在');
        }

        return $attachment;
    }

    /**
     * 附件 - 创建.
     */
    public function create(UploadedFile $uploadedFile, array $data): Attachment
    {
        return $this->repo->create($this->buildData($uploadedFile, $data));
    }

    /**
     * 附件 - 修改.
     */
    public function update(Attachment $attachment, array $data, UploadedFile $uploadedFile): Attachment
    {
        return $this->repo->update($attachment, $this->buildData($uploadedFile, $data));
    }

    /**
     * 附件 - 删除.
     */
    public function delete(Attachment $attachment): bool
    {
        return $this->repo->delete($attachment);
    }

    /**
     * 附件 - 组装数据.
     */
    protected function buildData(UploadedFile $uploadedFile, array $data): array
    {
        return [
            'userId' => Context::get(ContextKey::UID),
            'storageMode' => config('file.default'),
            'name' => $uploadedFile->getClientFilename(),
            'type' => $uploadedFile->getClientMediaType(),
            'size' => $uploadedFile->getSize(),
            'path' => $data['path'],
            'hash' => $data['hash'],
        ];
    }
}
