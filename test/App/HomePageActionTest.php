<?php

namespace test\App;

use App\Home\HomePageAction;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response;
use PHPUnit\Framework\TestCase;
use rollun\dic\InsideConstruct;
use Zend\Diactoros\ServerRequest;
use Zend\Expressive\Template\TemplateRendererInterface;
use rollun\datastore\DataStore\Interfaces\DataStoresInterface;
use Zend\Stratigility\Delegate\CallableDelegateDecorator;

class HomePageActionTest extends TestCase
{
    protected $dataStore;

    protected $template;

    public function __construct(DataStoresInterface $dataStore = null, TemplateRendererInterface $template = null)
    {
        parent::__construct();

        InsideConstruct::init([
            'dataStore' => 'bookCsvStore',
            'template' => TemplateRendererInterface::class
        ]);
    }

    public function testFirst()
    {
        $this->assertTrue($this->dataStore instanceof DataStoresInterface);
        $this->assertTrue($this->template instanceof TemplateRendererInterface);
        $this->assertTrue(true);
    }

    public function testProcess()
    {
        $homePageAction = new HomePageAction($this->dataStore, $this->template);
        $request = new ServerRequest();
        $delegate = new CallableDelegateDecorator(function ($request, $delegate) {
            throw new \Exception('Wrong delegator call');
        }, new Response());

        $response = $homePageAction->process($request, $delegate);

        $this->assertTrue($response instanceof HtmlResponse);
        $this->assertEquals('first book', $response->getBody()->getContents());
    }
}
