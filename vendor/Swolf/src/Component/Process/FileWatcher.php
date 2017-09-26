<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/9/26
 * @Time: 9:57
 */

namespace Swolf\Component\Process;

use Swolf\Interfaces\Process;
use Swolf\Container\Resource;

class FileWatcher implements Process
{


    protected $useInotify = false;


    protected $inotifyInstance;


    protected $watchDescriptor = [];


    protected $watchTarget = [];


    public function __construct($useInotify = false)
    {
        $this->useInotify = $useInotify;
        if ($useInotify) {
            $this->inotifyInstance = inotify_init();
        }
    }

    public function addWatchTarget($pathname)
    {

        $target = new WatchTarget($pathname);

        if ($this->useInotify) {
            $watchDescriptor = inotify_add_watch($this->inotifyInstance, $target, IN_CREATE | IN_MODIFY | IN_DELETE);
            $this->watchDescriptor[$target] = $watchDescriptor;
            return;
        }

        $this->watchTarget[$target] = $target;

    }


    public function removeWatchTarget($pathname)
    {

        $target = new WatchTarget($pathname);

        if ($this->useInotify) {
            if (!inotify_rm_watch($this->inotifyInstance, $this->watchDescriptor[$target])) {
                throw new \Exception('cannot remove target from target list.');
            }
            return true;
        }
        unset($this->watchTarget[$target]);
        return true;
    }

    public function watch()
    {

        if ($this->useInotify) {
            while (true) {
                inotify_read($this->inotifyInstance);//blocked.
                Resource::$server->reload();
            }
            return;
        }

        while (true) {

            if ($this->isTargetChanged()) {
                Resource::$server->reload();
            }
            sleep(1);
        }
    }


    protected function isTargetChanged()
    {
        foreach ($this->watchTarget as $k => $v) {
            if ($v->hash() !== $v->hashResult) {
                return true;
            }
        }
        return false;

    }


    public function process(\Swoole\Process $process)
    {
        $this->watch();
    }
}


class WatchTarget
{

    private $absPath;


    public $hashResult = '';


    public function __construct($path)
    {
        $absPath = realpath($path);
        if ($absPath === false) {
            throw new \Exception('the file or directory is not exists.');
        }
        $this->absPath = $absPath;
    }


    public function isChanged()
    {
        static $hashResult;
        $hr = $this->hash();
        $equal = $hr == $hashResult;
        $hashResult = $hr;
        return $equal;
    }


    public function hash()
    {
        $files = scandir($this->absPath);
        $md5str = '';
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


    public function __toString()
    {
        return $this->absPath;
    }


}