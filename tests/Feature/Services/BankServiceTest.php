<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Tests\Feature\Services;

use WebAppId\Bank\Services\BankService;
use WebAppId\Bank\Services\Requests\BankServiceRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\Bank\Tests\Unit\Repositories\BankRepositoryTest;
use WebAppId\Bank\Tests\TestCase;
use WebAppId\DDD\Tools\Lazy;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankServiceResponseList
 * @package WebAppId\Bank\Tests\Feature\Services
 */
class BankServiceTest extends TestCase
{

    /**
     * @var BankService
     */
    protected $bankService;

    /**
     * @var BankRepositoryTest
     */
    protected $bankRepositoryTest;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->bankService = $this->container->make(BankService::class);
            $this->bankRepositoryTest = $this->container->make(BankRepositoryTest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }

    }

    public function testGetById()
    {
        $contentServiceResponse = $this->testStore();
        $result = $this->container->call([$this->bankService, 'getById'], ['id' => $contentServiceResponse->bank->id]);
        self::assertTrue($result->status);
    }

    private function getDummy(int $number = 0): BankServiceRequest
    {
        $bankRepositoryRequest = $this->container->call([$this->bankRepositoryTest, 'getDummy'], ['no' => $number]);
        $bankServiceRequest = null;
        try {
            $bankServiceRequest = $this->container->make(BankServiceRequest::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
        return Lazy::copy($bankRepositoryRequest, $bankServiceRequest, Lazy::AUTOCAST);
    }

    public function testStore(int $number = 0)
    {
        $bankServiceRequest = $this->getDummy($number);
        $result = $this->container->call([$this->bankService, 'store'], ['bankServiceRequest' => $bankServiceRequest]);
        self::assertTrue($result->status);
        return $result;
    }

    public function testGet()
    {
        for ($i=0; $i<$this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++){
            $this->testStore($i);
        }
        $result = $this->container->call([$this->bankService, 'get']);
        self::assertTrue($result->status);
    }

    public function testGetCount()
    {
        for ($i=0; $i<$this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++){
            $this->testStore($i);
        }
        $result = $this->container->call([$this->bankService, 'getCount']);
        self::assertGreaterThanOrEqual(1, $result);
    }

    public function testUpdate()
    {
        $contentServiceResponse = $this->testStore();
        $bankServiceRequest = $this->getDummy();
        $result = $this->container->call([$this->bankService, 'update'], ['id' => $contentServiceResponse->bank->id, 'bankServiceRequest' => $bankServiceRequest]);
        self::assertNotEquals(null, $result);
    }

    public function testDelete()
    {
        $contentServiceResponse = $this->testStore();
        $result = $this->container->call([$this->bankService, 'delete'], ['id' => $contentServiceResponse->bank->id]);
        self::assertTrue($result);
    }

    public function testGetWhere()
    {
        for ($i = 0; $i < $this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++) {
            $this->testStore($i);
        }
        $string = 'aiueo';
        $q = $string[$this->getFaker()->numberBetween(0, strlen($string) - 1)];
        $result = $this->container->call([$this->bankService, 'get'], ['q' => $q]);
        self::assertTrue($result->status);
    }

    public function testGetWhereCount()
    {
        for ($i = 0; $i < $this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++) {
            $this->testStore($i);
        }
        $string = 'aiueo';
        $q = $string[$this->getFaker()->numberBetween(0, strlen($string) - 1)];
        $result = $this->container->call([$this->bankService, 'getCount'], ['q' => $q]);
        self::assertGreaterThanOrEqual(1, $result);
    }
}
