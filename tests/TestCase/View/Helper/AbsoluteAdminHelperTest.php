<?php

namespace AbsoluteAdmin\Test\TestCase\View\Helper;

use AbsoluteAdmin\View\Helper\AbsoluteAdminHelper;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\View\View;

class AbsoluteAdminHelperTest extends TestCase
{

    public $fixtures = [
        'plugin.AbsoluteAdmin.Articles',
    ];

    public function setUp()
    {
        parent::setUp();

        $this->View = new View();
        $this->AbsoluteAdmin = new AbsoluteAdminHelper($this->View);

        Router::connect('/:controller', ['action' => 'index']);
        Router::connect('/:controller/:action/*');
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->AbsoluteAdmin, $this->View);
    }

    public function testNestedListFormat()
    {
        $Articles = TableRegistry::get('Articles');
        
        $article = $Articles->newEntity([
            'id' => 1,
            'title' => 'Foo',
            'author_id' => 2
        ]);

        $result = $this->AbsoluteAdmin->nestedListFormat([], $article);

        $expected = [
            'span',
            'a',
            'i',
            '/i',
            '/a',
            'form',
            '/form',
            'a',
            'i',
            '/i',
            '/a',
            '/span',
            'div',
            'Foo',
            '/div'
        ];

        $this->assertHtml($expected, $result, false);
    }
}