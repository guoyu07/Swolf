<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/16
 * @Time: 16:32
 */

namespace Swolf\Core\Interfaces\Http;

interface Response
{
    
    public function getStatus();

    public function getCode();


    public function getData();


    public function getMessage();

}