<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/24
 * @Time: 10:31
 */

namespace Swolf\Process\FileWatcher;

class WatchTarget
{

    /**
     * absolute path of file or directory.
     *
     * @var bool|string
     */
    private $absPath;


    /**
     * WatchTarget constructor.
     * get the target absolute path
     *
     * @param $path
     * @throws \Exception
     *if the target not exists. throw a Exception
     *
     */
    public function __construct($path)
    {
        $absPath = realpath($path);
        if ($absPath === false) {
            throw new \Exception('the file or directory is not exists.');
        }
        $this->absPath = $absPath;
    }

    /**
     * calculate the hash of target.And see whether the result is changed.
     *
     * @return bool
     */
    public function isChanged()
    {
        static $hashResult;
        $hr = $this->hash();
        $equal = $hr == $hashResult;
        $hashResult = $hr;
        return $equal;
    }


    /**
     * calculate the hash of result.
     * if the target is a directory, calculate the hash recursively.
     *
     * @return string
     */
    public function hash()
    {
        $md5str = '';

        $files = scandir($this->absPath);
        foreach ($files as $file) {
            if (is_dir($file)) {
                $t = new WatchTarget($file);
                $md5str .= $t->hash();
            } else {
                $md5str .= md5_file($file);
            }
        }

        return md5($md5str);

    }

    /**
     * use the object as array key. privide __toString()
     * so that the object can be transfered to string.
     *
     * @return bool|string
     */
    public function __toString()
    {
        return $this->absPath;
    }


}