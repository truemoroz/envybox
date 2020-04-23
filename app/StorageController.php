<?php


namespace App;


use Illuminate\Support\Facades\Storage as LaravelStorage;


abstract class StorageController
{
    static $types = [ 'file' => 'fileStorageController', 'mysql' => 'mysqlStorageController'];

    abstract public function getStorage(): Storage;

    public function save($content): void
    {
        $storage = $this->getStorage();
        $storage->saveData($content);
    }
}


class fileStorageController extends StorageController
{
    public function getStorage(): Storage
    {
        return new fileStorage();
    }
}

class mysqlStorageController extends StorageController
{
    public function getStorage(): Storage
    {
        // возвращаем объект для работы с mysql
        // return new mysql_storage
    }
}

interface Storage
{
    public function saveData($content): void;
}

class fileStorage implements Storage
{
    private $object;

    public function __construct()
    {
        $this->object = LaravelStorage::disk('local');
    }
    public function saveData($content): void
    {
        $content = implode(';', $content);
        $this->object->append('fileStorage', $content);
    }
}

class mysqlStorage implements Storage
{
    public function saveData($content): void
    {
        echo 'здесь сохраняем данные в mysql' . PHP_EOL;
    }
}
