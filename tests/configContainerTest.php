<?php

namespace Test;

require_once dirname(__DIR__) . '/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Swolf\Core\Container\Config;


class configContainerTest extends TestCase
{

    public function testSet()
    {
        Config::set('a.b.c', 1);
        $this->assertArrayHasKey('b', Config::get('a'));
        $this->assertArrayHasKey('c', Config::get('a.b'));
        $this->assertEquals(1, Config::get('a.b.c'));
    }


}