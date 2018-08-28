<?php

namespace App\Home;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use rollun\datastore\Rql\RqlParser;
use rollun\dic\InsideConstruct;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Expressive\Template\TemplateRendererInterface;
use rollun\datastore\DataStore\Interfaces\DataStoresInterface;

class HomePageAction implements ServerMiddlewareInterface
{
    protected $dataStore;

    protected $template;

    public function __construct(DataStoresInterface $dataStore = null, TemplateRendererInterface $template = null)
    {
        $depencies = InsideConstruct::init([
            'dataStore' => 'bookHttpStore',
            'template' => TemplateRendererInterface::class
        ]);
        print_r($depencies);
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $query = RqlParser::rqlDecode('or(eq(id,2),eq(id,3))sort(-id)select(name)');
        $books = $this->dataStore->query($query);

        return new HtmlResponse(json_encode($books));
    }
}
