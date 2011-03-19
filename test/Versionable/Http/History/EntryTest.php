<?php
namespace Versionable\Http\History;

require_once 'src/Versionable/Http/History/EntryInterface.php';
require_once 'src/Versionable/Http/History/Entry.php';

require_once 'src/Versionable/Http/Url/UrlInterface.php';
require_once 'src/Versionable/Http/Parameter/CollectionInterface.php';
require_once 'src/Versionable/Http/File/CollectionInterface.php';
require_once 'src/Versionable/Http/Header/CollectionInterface.php';
require_once 'src/Versionable/Http/Cookie/CollectionInterface.php';
require_once 'src/Versionable/Http/Request/RequestInterface.php';
require_once 'src/Versionable/Http/Response/ResponseInterface.php';

/**
 * Test class for Entry.
 * Generated by PHPUnit on 2011-03-19 at 11:47:27.
 */
class EntryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Entry
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $request = $this->getMock('Versionable\\Http\\Request\\RequestInterface');
        $response = $this->getMock('Versionable\\Http\\Response\\ResponseInterface');
        $this->object = new Entry($request, $response);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testGetRequest().
     */
    public function testGetRequest()
    {
        $this->assertEquals($this->readAttribute($this->object, 'request'), $this->object->getRequest());
    }

    /**
     * @todo Implement testSetRequest().
     */
    public function testSetRequest()
    {
        $request = $this->getMock('Versionable\\Http\\Request\\RequestInterface');
        
        $this->object->setRequest($request);
        $this->assertEquals($request, $this->readAttribute($this->object, 'request'));
    }

    /**
     * @todo Implement testGetResponse().
     */
    public function testGetResponse()
    {
        $this->assertEquals($this->readAttribute($this->object, 'response'), $this->object->getResponse());
    }

    /**
     * @todo Implement testSetResponse().
     */
    public function testSetResponse()
    {
        $response = $this->getMock('Versionable\\Http\\Response\\ResponseInterface');
        
        $this->object->setResponse($response);
        $this->assertEquals($response, $this->readAttribute($this->object, 'response'));
    }
}
