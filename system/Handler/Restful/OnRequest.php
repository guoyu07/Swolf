<?php
//MIT License
//
//Copyright (c) 2017 清和
//
//Permission is hereby granted, free of charge, to any person obtaining a copy
//of this software and associated documentation files (the "Software"), to deal
//in the Software without restriction, including without limitation the rights
//to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//copies of the Software, and to permit persons to whom the Software is
//furnished to do so, subject to the following conditions:
//
//The above copyright notice and this permission notice shall be included in all
//copies or substantial portions of the Software.
//
//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//                                           LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
//SOFTWARE.

namespace Swolf\Handler\Restful;

use DevLibs\Routing\Router;
use Swolf\Core\Container\IO;
use Swolf\Core\Server\Handler;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swolf\Component\Http\Middleware\MiddlewareInterface;
use Swolf\Component\Http\Response\ResponseInterface;


class OnRequest implements Handler
{


    /**
     * @var callable
     */
    protected $requestHandler;

    /**
     * @var Router
     */
    protected $router;


    public function __construct()
    {
    }


    public function handlerType(): int
    {
        return self::Request;
    }


    public function handleFunc(): callable
    {
        return function (&$server) {
            $server->on('request', function ($request, $response) {
                call_user_func($this->requestHandler, $request, $response);
            });
        };
    }


    protected function initRouter(array $routers)
    {
        $this->router = new Router();

        foreach ($routers as $router) {
            $paramArr = explode('@', $router['action']);
            if (count($paramArr) < 2) {
                $method = 'index';
            } else {
                $method = $paramArr[1];
            }
            $class = $paramArr[0];
            call_user_func([$this->router, $router['method']], $router['path'], [new $class, $method]);
        }
    }


    protected function initMiddleware(array $middlewares)
    {
        $requestHandler = $this->getRequestHandler();

        foreach (array_reverse($middlewares) as $middlewareClass) {
            $middleware = new $middlewareClass;
            if ($middleware instanceof MiddlewareInterface) {
                $requestHandler = function (Request $request, Response $response) use ($middleware, $requestHandler) {
                    $middleware->handle($request, $response, $requestHandler);
                };
            }
        }
        $this->requestHandler = $requestHandler;
    }


    protected function getRequestHandler()
    {
        return function (Request $request, Response $response) {

            $route = $this->route($request);

            if (is_null($route)) {
                $response->status(404);
                $response->end('Not Found.');
                return 404;
            }

            $resp = call_user_func($route->handler(), $request);

            if (!$resp instanceof ResponseInterface) {
                IO::output()->error('service method must return interface response, but ' . gettype($resp) . ' was returned.');
                $response->status(500);
                $response->end('Internal Server Error.');
                return 500;
            }

            $ret = [
                'CODE' => $resp->getCode(),
                'DATA' => $resp->getData(),
                'MESSAGE' => $resp->getMessage(),
            ];
            $response->header('Content-Type', 'application/json');
            $response->end(json_encode($ret));
            return 200;
        };
    }


    protected function route(Request $request)
    {
        return $this->router->dispatch($request->server['request_method'], $request->server['request_uri']);
    }


}