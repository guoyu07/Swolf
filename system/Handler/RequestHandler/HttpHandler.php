<?php

namespace Swolf\Handler\RequestHandler;

use Swolf\Core\Container\IO;
use Swolf\Core\Interfaces\RequestHandler;
use Swoole\Http\Request;
use Swoole\Http\Response;
use App\Config\Middleware;
use Swolf\Component\Middleware\Middleware as MiddlewareInterface;
use Swolf\Component\Http\Interfaces\Response as ResponseInterface;


class HttpHandler implements RequestHandler
{

    protected $closure;

    public function __construct()
    {
        $closure = function (Request $request, Response $response) {

            $req = $this->parseRequest($request);
            $method = $req->method;
            $class = $req->class;
            try {
                $object = new $class;
            } catch (\Exception $exception) {
                $response->status(404);
                return 404;
            }
            if (!method_exists($object, $method)) {
                $response->status(404);
                return 404;
            }
            $resp = call_user_func([$object, $method], $request);
            if (!$resp instanceof ResponseInterface) {
                IO::output()->error('service method must return interface response, but ' . gettype($resp) . ' was returned.');
                $response->status(500);
                $response->end('Internal Server Error.');
                return 500;
            }

            $ret = [
                'RET' => $resp->getCode(),
                'DATA' => $resp->getData(),
                'MESSAGE' => $resp->getMessage(),
            ];
            $response->header('Content-Type', 'application/json');
            $response->end(json_encode($ret));
            return 200;
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
        call_user_func($this->closure, $request, $response);
    }

    public function parseRequest(Request $request)
    {
        $resp = new \stdClass();
        $uri = $request->server['request_uri'];

        $segs = explode('/', trim($uri, '/'));

        switch ($num = count($segs)) {
            case $num < 1:
                $resp->method = 'index';
                $resp->class = 'App\Controller\Index';
                break;
            case $num < 2:
                $resp->method = 'index';
                $resp->class = 'App\Controller\\' . ucfirst($segs[0]);
                break;
            default:
                $last = $num - 1;
                $resp->method = $segs[$last];
                unset($segs[$last]);
                $resp->class = 'App\Controller\\' . ucfirst(implode('\\', $segs));
        }
        return $resp;
    }


}