<?php
class File
{
    protected $uploadPath;
    protected $uploadInfo;

    public function __construct($uploadDir)
    {
        $this->uploadPath= $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
    }

    protected function isErrors($filesInfo)
    {
        $fileExtension = strtolower(pathinfo($filesInfo['fileAjax']['name'], PATHINFO_EXTENSION));

        if (!isset($filesInfo['fileAjax']['tmp_name'])) {
            $this->uploadInfo = 'ошибка загрузки файла';
            return true;
        }
        if ($fileExtension !== 'txt') {
            $this->uploadInfo = "допускаются только txt";
            return true;
        }
        
        return false;
    }

    protected function uploadFile($filesInfo)
    {
        if ($this->isErrors($filesInfo)) {
            return false;
        }

        if (!move_uploaded_file($filesInfo['fileAjax']['tmp_name'], $this->uploadPath . $filesInfo['fileAjax']['name'])) {
            $this->uploadInfo = 'Во время загрузки произошла ошибка. Попробуйте еще раз!';
            return false;
        } else {
            $this->uploadInfo = 'Загрузка прошла успешно';
            return true;
        }
    }

    protected function readFile($name)
    {
        $content = file_get_contents($name);
        return ($content) ? $content : false;
    }

    public function getResponce($filesInfo, $delimiter)
    {
        if (!$this->uploadFile($filesInfo)) {
            return json_encode(['info' =>$this->uploadInfo]);
        }

        $content = $this->readFile($this->uploadPath . $filesInfo['fileAjax']['name']);
        $fileArray = preg_split("/" . $delimiter . "/", $content, -1, PREG_SPLIT_NO_EMPTY);
        $resultArray = [];

        if ($fileArray) {
            foreach ($fileArray as $line) {
                $resultArray[] = ['line' => $line,'length' => strlen($line) ];
            }
        }
        $finalArray = ['results' =>  $resultArray, 'info' =>$this->uploadInfo];

        return json_encode($finalArray);
    }
}
