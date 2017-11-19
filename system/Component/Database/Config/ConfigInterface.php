<?php
/**
 * Created by PhpStorm.
 * User: diki
 * Date: 17-11-20
 * Time: 上午12:02
 */

namespace Swolf\Component\Database\Config;

interface ConfigInterface
{

    public function getHost();


    public function getUser();


    public function getPassword();


    public function getPort();


    public function getOptions();


    public function getDriver();


    public function getDBs();


}