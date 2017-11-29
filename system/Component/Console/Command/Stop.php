<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/24
 * @Time: 10:46
 */

namespace Swolf\Component\Console\Command;

use Inhere\Console\Command;

class Stop extends Command
{
    protected static $name = 'stop';

    protected static $description = 'stop the server';


    public function execute($input, $output)
    {
        if (!file_exists()) {
        }

        $pid = file_get_contents(Server::$setting['pid_file']);

        if (!posix_kill($pid, SIGKILL)) {
            $out->error('can not stop process ' . $pid, true);
        }

        unlink(Server::$setting['pid_file']);

    }
}
