<?php

/**
 * 生成した画像データをpngファイルにして、プロジェクト内に保存するクラスです。
 */
class ImageSaver
{
    private $parentDirectory;

    public function __construct()
    {
        $this->parentDirectory = dirname(__DIR__);
    }

    /**
     * 画像をプロジェクト内(src/php/outputフォルダ内に)保存します。
     *
     * @param string $imgData 保存する画像データ（Base64形式）
     * @return string 保存された画像のファイル名
     */
    public function saveImage($imgData): string
    {
        $decodedImgData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imgData));

        $filename = '日報_' . date('Ymd') . '.png';
        $savePath = $this->parentDirectory . '/' . 'output' . '/' . $filename;

        file_put_contents($savePath, $decodedImgData);

        return $filename;
    }
}
