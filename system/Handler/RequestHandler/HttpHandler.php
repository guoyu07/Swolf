<?php

namespace Swolf\Handler\RequestHandler;

use App\Config\Routes;
use DevLibs\Routing\Router;
use Swolf\Core\Container\IO;
use Swolf\Core\Interfaces\RequestHandler;
use Swoole\Http\Request;
use Swoole\Http\Response;
use App\Config\Middleware;
use Swolf\Component\Middleware\Middleware as MiddlewareInterface;
use Swolf\Component\Http\Interfaces\Response as ResponseInterface;


class HttpHandler implements RequestHandler
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
        $this->initRouter();

        $this->initMiddleware();
    }


    public function onRequest(Request $request, Response $response)
    {
        IO::output()->table([array_keys($request->server),array_values($request->server)]);
        call_user_func($this->requestHandler, $request, $response);
    }


    private function initRouter()
    {
        $this->router = new Router();

        foreach (Routes::$get as $path => $action) {
            $paramArr = explode('@', $action);
            if (count($paramArr) < 2) {
                $method = 'index';
            } else {
                $method = $paramArr[1];
            }
            $class = $paramArr[0];
            $classObject = new $class;
            $this->router->get($path, [$classObject, $method]);
        }
    }


    private function initMiddleware()
    {
        $requestHandler = $this->getRequestHandler();

        foreach (array_reverse(Middleware::$http) as $middlewareClass) {
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