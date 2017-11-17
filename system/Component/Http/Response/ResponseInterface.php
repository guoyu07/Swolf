<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/16
 * @Time: 16:32
 */

namespace Swolf\Component\Http\Response;

interface ResponseInterface
{

    public function getCode();


    public function getData();


    public function getMessage();

}