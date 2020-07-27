<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Tests\Unit\Repositories;

use WebAppId\Bank\Models\Bank;
use WebAppId\Bank\Repositories\BankRepository;
use WebAppId\Bank\Repositories\Requests\BankRepositoryRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use WebAppId\Bank\Tests\TestCase;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankServiceResponseList
 * @package Tests\Unit\Repositories
 */
class BankRepositoryTest extends TestCase
{

    /**
     * @var BankRepository
     */
    private $bankRepository;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        try {
            $this->bankRepository = $this->container->make(BankRepository::class);
        } catch (BindingResolutionException $e) {
            report($e);
        }
    }

    public function getDummy(int $no = 0): ?BankRepositoryRequest
    {
        $dummy = null;
        try {
            $dummy = $this->container->make(BankRepositoryRequest::class);
            $dummy->code = $this->getFaker()->text(255);
            $dummy->name = $this->getFaker()->text(255);
            $dummy->status = $this->getFaker()->boolean ? "y" : "n";

        } catch (BindingResolutionException $e) {
            report($e);
        }
        return $dummy;
    }

    public function testStore(int $no = 0): ?Bank
    {
        $bankRepositoryRequest = $this->getDummy($no);
        $result = $this->container->call([$this->bankRepository, 'store'], ['bankRepositoryRequest' => $bankRepositoryRequest]);
        self::assertNotEquals(null, $result);
        return $result;
    }

    public function testGetById()
    {
        $bank = $this->testStore();
        $result = $this->container->call([$this->bankRepository, 'getById'], ['id' => $bank->id]);
        self::assertNotEquals(null, $result);
    }

    public function testDelete()
    {
        $bank = $this->testStore();
        $result = $this->container->call([$this->bankRepository, 'delete'], ['id' => $bank->id]);
        self::assertTrue($result);
    }

    public function testGet()
    {
        for ($i = 0; $i < $this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++) {
            $this->testStore($i);
        }

        $resultList = $this->container->call([$this->bankRepository, 'get']);
        self::assertGreaterThanOrEqual(1, count($resultList));
    }

    public function testGetCount()
    {
        for ($i = 0; $i < $this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++) {
            $this->testStore($i);
        }

        $result = $this->container->call([$this->bankRepository, 'getCount']);
        self::assertGreaterThanOrEqual(1, $result);
    }

    public function testUpdate()
    {
        $bank = $this->testStore();
        $bankRepositoryRequest = $this->getDummy(1);
        $result = $this->container->call([$this->bankRepository, 'update'], ['id' => $bank->id, 'bankRepositoryRequest' => $bankRepositoryRequest]);
        self::assertNotEquals(null, $result);
    }

    public function testGetWhere()
    {
        for ($i = 0; $i < $this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++) {
            $this->testStore($i);
        }
        $string = 'aiueo';
        $q = $string[$this->getFaker()->numberBetween(0, strlen($string) - 1)];
        $result = $this->container->call([$this->bankRepository, 'get'], ['q' => $q]);
        self::assertGreaterThanOrEqual(1, count($result));
    }

    public function testGetWhereCount()
    {
        for ($i = 0; $i < $this->getFaker()->numberBetween(10, $this->getFaker()->numberBetween(10, 30)); $i++) {
            $this->testStore($i);
        }
        $string = 'aiueo';
        $q = $string[$this->getFaker()->numberBetween(0, strlen($string) - 1)];
        $result = $this->container->call([$this->bankRepository, 'getCount'], ['q' => $q]);
        self::assertGreaterThanOrEqual(1, $result);
    }
}
