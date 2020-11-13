<?php

/**
 * Created by : PhpStorm
 * User: zsl
 * Date: 2020/10/18
 * Time: 22:17
 */

namespace App\Service;

class Util
{
    private string $imgDomainName;

    public function __construct(string $imgDomainName)
    {
        $this->imgDomainName = $imgDomainName;
    }

    public function upload(array $files): string
    {

        header('Access-Control-Allow-Origin:*'); // *代表允许任何网址请求

        $dir     = './upload' . DIRECTORY_SEPARATOR . date("Y-m-d");
        $fileUrl = DIRECTORY_SEPARATOR . date("Y-m-d");
        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }
        // 判断当前目录下的 upload 目录是否存在该文件
        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
        $file = $files["file"] ?? null;
        if ($file) {
            $random   = time() . mt_rand(100, 999);
            $filePath = $dir . DIRECTORY_SEPARATOR . $random . $file["name"];
            $fileUrl  = $fileUrl . DIRECTORY_SEPARATOR . $random . $file["name"];
            if (file_exists($filePath)) {
                return 'err ';
            } else {
                // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($file["tmp_name"], $filePath);
                return $this->imgDomainName . $fileUrl;
            }
        }
        return 'err';
    }
}
