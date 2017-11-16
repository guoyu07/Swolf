<?php
/**
 * @Description:
 * @Author: chenchao
 * @Date: 2017/11/16
 * @Time: 16:32
 */

namespace Swolf\Component\Http\Interfaces;

interface Response
{

    public function getCode();


    public function getData();


    public function getMessage();

}