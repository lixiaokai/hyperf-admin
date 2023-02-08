<?php

declare(strict_types=1);

namespace App\Demo\Controller;

use Core\Controller\BaseController;
use Core\Response\Response;
use Core\Service\File\UploadService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
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
     */
    public function upload(): ResponseInterface
    {
        $uploadedFile = $this->request->file('upload');
        $res = $this->uploadService->upload($uploadedFile);

        return Response::success($res);
    }
}
