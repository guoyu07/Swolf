<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/24
 * @Time: 10:25
 */

namespace Swolf\Component\Console\Command;

use Inhere\Console\Command as BaseCommand;

class Start extends BaseCommand
{

    protected static $name = 'start';


    protected static $description = 'start server';


    /**
     * the priority of server's settings is:
     *      cli > config > default
     * which means if the commandline options is set and
     * different with config file, the options pointed by config file
     * will be override by commandline options.
     * if neither commandline or config file pointed required options,
     * the default value will be used.
     *
     */
    public function execute($input, $output)
    {
        $host = $input->getOption('h');
        $port = $input->getOption('p');
        $daemon = $input->getBoolOpt('d');

        $serverConfig = new ServerConfig();

        $serverConfig->setHost($host);
        $serverConfig->setPort($port);
        $serverConfig->deamonize($daemon);

        if (function_exists('cli_set_process_title')) {
            cli_set_process_title($serverConfig->getApp());
        } else {
            swoole_set_process_name($serverConfig->getApp());
        }

        $server = ServerFactory::instance($serverConfig);

        $output->info('server is running at ' . $serverConfig->getHost() . ':' . $serverConfig->getPort());

        try {
            $server->run();
        } catch (Exception $e) {
            $output->error('start server failed: ' . $e->getMessage());
        }
    }
}