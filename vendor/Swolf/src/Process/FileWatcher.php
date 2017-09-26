<?php


namespace Swolf\Process;

use Swolf\Core\Interfaces\Process;
use Swolf\Core\Container\Resource;

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


    public function process(\Swoole\Process $process)
    {
        $this->watch();
    }
}


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