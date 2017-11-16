<?php
/**
 * @Description:
 * @Author: chenqinghe
 * @Date: 2017/11/16
 * @Time: 16:36
 */

namespace Swolf\Component\Http\Response;

use Swolf\Component\Http\Interfaces\Response as ResponseInterface;

class Response implements ResponseInterface
{
    protected $code, $data, $message;


    public function __construct($code = 0, $data = null, $message = '')
    {
        $this->code = $code;
        $this->data = $data;
        $this->message = $message;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getCode()
    {
        return $this->code;
    }
}