<?php


namespace Swolf\Process;

use Swolf\Core\Server\Process;
use Swolf\Core\Container\Resource;
use Swolf\Process\FileWatcher\WatchTarget;

class FileWatcher implements Process
{

    /**
     * use inotify extension or not.
     *
     * @var bool
     */
    protected $useInotify = false;


    /**
     * inotify resource
     *
     * @var resource
     */
    protected $inotifyInstance;


    /**
     * inotify watch descriptor.
     *
     * @var array
     */
    protected $watchDescriptor = [];


    /**
     * list of directories or files that to be watched.
     *
     * @var array
     */
    protected $watchTarget = [];


    public function __construct($useInotify = false)
    {
        $this->useInotify = $useInotify;
        if ($useInotify) {
            $this->inotifyInstance = inotify_init();
        }
    }


    /**
     * add a file or directory to watch.
     *
     * @param string $pathname
     */
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


    /**
     * delete watch target.
     *
     * @param $pathname
     * @return bool
     * @throws \Exception
     */
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


    /**
     * watching files.
     *
     */
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


    /**
     * if the file or directory has been changed.
     *
     * @return bool
     */
    protected function isTargetChanged()
    {
        foreach ($this->watchTarget as $k => $v) {
            if ($v->hash() !== $v->hashResult) {
                return true;
            }
        }
        return false;

    }


    public function execute(\Swoole\Process $process)
    {
        $this->watch();
    }
}


