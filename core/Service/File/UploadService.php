<?php

namespace Core\Service\File;

use Carbon\Carbon;
use Core\Model\Attachment;
use Core\Service\AttachmentService;
use Core\Service\BaseService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Upload\UploadedFile;
use Kernel\Exception\BusinessException;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;

/**
 * 上传 - 服务类.
 */
class UploadService extends BaseService
{
    /** @Inject */
    protected AttachmentService $attachmentService;

    /** @Inject */
    protected Filesystem $filesystem;

    protected UploadedFile $uploadedFile;

    /**
     * 上传并入库.
     */
    public function upload(UploadedFile $uploadedFile): Attachment
    {
        if (! $uploadedFile->isValid()) {
            throw new BusinessException('上传失败: ' . $uploadedFile->getError());
        }

        // 1. md5 检查附件是否存在
        $hash = md5_file($uploadedFile->getRealPath());
        $attachment = $this->attachmentService->getByHash($hash, false);

        // 2. 不存在则上传 + 入库
        if ($attachment === null) {
            $fullSaveName = $this->uploadHandle($uploadedFile);
            $attachment = $this->attachmentService->create($uploadedFile, $fullSaveName, $hash);
        }

        return $attachment;
    }

    /**
     * 上传处理.
     */
    public function uploadHandle(UploadedFile $uploadedFile): string
    {
        $this->setUploadedFile($uploadedFile);

        // 文件存储路径
        $fullSaveName = $this->getFullSaveName();

        try {
            $this->filesystem->writeStream($fullSaveName, $this->uploadedFile->getStream()->detach());
        } catch (FilesystemException $e) {
            throw new BusinessException($e->getMessage());
        }

        return $fullSaveName;
    }

    /**
     * 设置 - 上传的文件.
     */
    protected function setUploadedFile(UploadedFile $uploadedFile): self
    {
        $this->uploadedFile = $uploadedFile;

        return $this;
    }

    /**
     * 获取 - 完整存储文件名 ( 带路径 ).
     */
    protected function getFullSaveName(): string
    {
        return $this->getSavePath() . '/' . $this->getSaveName();
    }

    /**
     * 获取 - 保存路径.
     */
    protected function getSavePath(): string
    {
        return Carbon::now()->format('ym');
    }

    /**
     * 获取 - 保存的文件名.
     */
    protected function getSaveName(): string
    {
        return Carbon::now()->format('Hisu') . '.' . strtolower($this->uploadedFile->getExtension());
    }
}
