<?php
header('Content-Type: text/html; charset=UTF-8');
/**
 * Class ZipArchiv
 *
 */

class ZipArchiv
{
    public $arr_upld_files = [];
    public $path_to_file = __DIR__ . '/files/';
    public $path_to_archive = __DIR__ . '/archives/';

    /**
     * При создании объекта проверям существование ранее загруженных файлов (true проверять, false не проверять)
     * если файлы существуют, то можно сразу загружать или добавить следующий пакет файлов и тогда архивировать
     */
    public function __construct($check_files)
    {
        if ($check_files) {
            foreach (scandir(__DIR__ . '/files') as $exists_file) {
                if ($exists_file == '.' || $exists_file == '..') {
                    continue;
                }
                $this->arr_upld_files[] = $exists_file;
            }
        }
    }

    /**
     * Получаем имя загруженного файла, записываем в массив arr_upld_files[]
     * возвращает bool
     */
    public function AddFile($path)
    {
        $this->arr_upld_files[] = $path;

        return true;
    }

    /**
     * создает zip c именем $file_name
     * проверка:
     * существует ли список файлов для добавления
     * проверка существования файла c именем $file_name, предотвращение перезаписи
     */
    public function Archive($file_name)
    {
        if (sizeof($this->arr_upld_files) == 0) {
            exit ('Нечего архивировать');
        }
        if (file_exists($this->path_to_archive . $file_name)) {
            exit ('Файл уже существует, выберите другое имя');
        }
        $zip = new ZipArchive();
        $filename_archive = $this->path_to_archive . $file_name;

        if ($zip->open($filename_archive, ZipArchive::CREATE) !== TRUE) {
            exit("Невозможно создать архив <$filename_archive>\n");
        }

        foreach ($this->arr_upld_files as $upld_file) {
            $zip->addFile($this->path_to_file . $upld_file, $upld_file);
        }

        $zip->close();
        if (file_exists($this->path_to_archive . $file_name)) {
            echo('файл создан <br>' . $this->path_to_archive . $file_name . '<br>');

            return true;
        }
    }
}