<?php

declare(strict_types=1);

namespace App\Demo\Controller;

use App\Demo\Resource\FileResource;
use Core\Controller\BaseController;
use Core\Service\File\UploadService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use League\Flysystem\FilesystemException;
use Psr\Http\Message\ResponseInterface;

/**
 * 文件系统演示 - 控制器.
 *
 * @Controller(prefix="demo/file")
 */
class FileController extends BaseController
{
    /** @Inject */
    protected UploadService $uploadService;

    /**
     * 文件系统演示 - 上传.
     *
     * @RequestMapping(path="upload", methods="post")
     * @throws FilesystemException
     */
    public function upload(): ResponseInterface
    {
        $uploadedFile = $this->request->file('upload');
        $res = $this->uploadService->upload($uploadedFile);

        return FileResource::make($res);
    }
}
