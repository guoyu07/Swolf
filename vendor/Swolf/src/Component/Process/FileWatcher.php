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


    protected $useInotify;


    protected $inotifyInstance;


    protected $watchDescriptor;


    public function __construct($useInotify = false)
    {
        $this->useInotify = $useInotify;
        if ($useInotify) {
            $this->inotifyInstance = inotify_init();
        }
    }

    public function addWatchTarget($pathname)
    {
        if ($this->useInotify) {
            $watchDescriptor = inotify_add_watch($this->inotifyInstance, $pathname, IN_CREATE | IN_MODIFY | IN_DELETE);
            $this->watchDescriptor[] = $watchDescriptor;
        }


    }


    protected function getAbsolutePath($path)
    {

    }


    public function removeWatchTarget($pathname)
    {

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

            if ($this->isChanged()) {
                Resource::$server->reload();
            }
            sleep(1);
        }
    }


    protected function isChanged()
    {

    }


    public function process(\Swoole\Process $process)
    {
        $this->watch();
    }
}