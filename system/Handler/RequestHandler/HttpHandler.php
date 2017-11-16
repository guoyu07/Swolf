<?php

namespace App\Handler\RequestHandler;

use Swolf\Core\Interfaces\RequestHandler;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swolf\Handler\RequestHandler\HttpBaseHandler;
use App\Config\Middleware;
use Swolf\Component\Middleware\Middleware as MiddlewareInterface;


class HttpHandler extends HttpBaseHandler implements RequestHandler
{

    protected $closure;

    public function __construct()
    {
        $closure = function (Request $request, Response $response) {

            $req = $this->parseRequest($request);
            $method = $req->method;
            $class = $req->class;

            return (new $class)->$method($request, $response);
        };

        foreach (array_reverse(Middleware::$http) as $v) {
            $obj = new $v;
            if ($obj instanceof MiddlewareInterface) {
                $closure = function (Request $request, Response $response) use ($obj, $closure) {
                    $obj->handle($request, $response, $closure);
                };
            }
        }
        $this->closure = $closure;
    }


    public function onRequest(Request $request, Response $response)
    {
        call_user_func_array($this->closure, [$request, $response]);
    }

    public function parseRequest(Request $request)
    {
        $uri = $request->server['request_uri'];
        $segs = explode('/', $uri);
        if (count($segs) < 1) {
            $method = 'index';
            $class = 'App\\Controller\\Index';
            goto RET;
        }
        if (count($segs) < 2) {
            $method = 'index';
            $class = ucfirst($segs[0]);
            goto RET;
        }
        $method = $segs[count($segs) - 1];
        unset($segs[count($segs) - 1]);
        $class = implode('', $segs);

        RET:
        $std = new \stdClass();
        $std->method = $method;
        $std->class = 'App\\Controller\\' . ucfirst($class);
        return $std;
    }


}