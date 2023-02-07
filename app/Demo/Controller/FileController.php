<?php

declare(strict_types=1);

namespace App\Demo\Controller;

use Carbon\Carbon;
use Core\Controller\BaseController;
use Core\Response\Response;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Kernel\Exception\BusinessException;
use League\Flysystem\Filesystem;
use League\Flysystem\FilesystemException;
use Psr\Http\Message\ResponseInterface;

/**
 * 文件系统演示 - 控制器.
 *
 * @Controller(prefix="demo/file")
 */
class FileController extends BaseController
{
    /**
     * 文件系统演示 - 上传.
     *
     * @RequestMapping(path="upload", methods="post")
     */
    public function upload(Filesystem $filesystem): ResponseInterface
    {
        $file = $this->request->file('upload');

        // 组装文件存储路径
        $dt = Carbon::now();
        $filePath = $dt->format('ym');
        $fileName = $dt->format('Hisu') . '.' . strtolower($file->getExtension());
        $saveFileName = $filePath . '/' . $fileName;
        $stream = fopen($file->getRealPath(), 'r+');

        try {
            $filesystem->writeStream($saveFileName, $stream);
        } catch (FilesystemException $e) {
            throw new BusinessException($e->getMessage());
        }

        // 可能存储适配器会提前关闭 $stream，比如阿里云 OSS 再处理 writeStream 时关闭了 $stream，这里就不再关闭
        if (is_resource($stream)) {
            fclose($stream);
        }

        return Response::success([
            'name' => $file->getClientFilename(),
            'type' => $file->getClientMediaType(),
            'size' => $file->getSize(),
            'path' => $saveFileName,
            'fullPath' => '根据不同的存储适配器组装',
        ]);
    }
}
