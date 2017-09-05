<?php

class Doting_KeyVal_Model_FileStorage
    implements Doting_KeyVal_Model_Storage
{

    private $path;

    public function __construct() {
        $this->path = Mage::getBaseDir('media').DIRECTORY_SEPARATOR.'keyval';
        if (!is_dir($this->path)) {
            mkdir($this->path);
        }
    }

    public function set($key, $value) {
        $file = md5($key);
        file_put_contents($this->getFilePath($file), $value);
    }

    public function get($key) {
        $file = md5($key);
        $file = $this->getFilePath($file);
        if (!is_file($file)) {
            throw new Exception('KeyVal: invalid key "'.$key.'"');
        }
        return file_get_contents($file);
    }

    public function has($key) {
        $file = md5($key);
        $file = $this->getFilePath($file);
        return is_file($file);
    }

    public function remove($key) {
        $file = md5($key);
        $file = $this->getFilePath($file);
        if (is_file($file)) {
            unlink($file);
        }
    }

    public function getFilePath($file) {
        return $this->path.DIRECTORY_SEPARATOR.$file;
    }

}
