<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-19
 * Time: 下午11:34
 */

namespace Swolf\Core\Interfaces\Server\Config;

interface Server
{

    /**
     * return the server event handlers.
     *
     * @return array
     */
    public function getHandlers(): array;


    /**
     * return the server type which can be one of
     *      1. tcp
     *      2. udp
     *      3. http
     *      4. websocket
     *
     * @return int
     */
    public function getServerType(): int;

    /**
     * return the application's version
     *
     * @return string
     */
    public function getVersion(): string;

    /**
     * return the port to listen to
     *
     * @return int
     */
    public function getPort(): int;


    /**
     * set the server port.
     * the options port was allowed to be overwrite by commandline arguments.
     * so we have to provide a method to modify port.
     *
     * @param int $port
     * @return bool
     */
    public function setPort(int $port): bool;


    /**
     * return the host to listen to
     *
     * @return string
     */
    public function getHost(): string;


    /**
     * set the server host.
     * the same as option port
     *
     * @param string $host
     * @return bool
     */
    public function setHost(string $host): bool;


    /**
     * if the argc greater than 0 and is boolean, the program will run as Deamonize
     * otherwise will return whether the program run as Deamonize or not
     *
     * @return bool
     */
    public function deamonize(...$deamon): bool;


}