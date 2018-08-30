<?php

namespace App\Home;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use rollun\callback\Callback\Callback;
use rollun\callback\Callback\Interruptor\Process;
use Zend\Diactoros\Response\HtmlResponse;

class HomePageAction implements ServerMiddlewareInterface
{
    protected $callback;

    public function __construct()
    {
        $this->callback = new Callback([$this, 'writeToFile']);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
//        call_user_func($this->callback, null);
        $interaptor = new Process($this->callback);
        $interaptor(null);
        return new HtmlResponse('Hello Word!');
    }

    public function writeToFile()
    {
        sleep(5);
        file_put_contents('data/test_callable.txt', time());
    }
}
