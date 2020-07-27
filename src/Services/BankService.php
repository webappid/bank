<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Services;

use WebAppId\Bank\Repositories\BankRepository;
use WebAppId\Bank\Repositories\Requests\BankRepositoryRequest;
use WebAppId\Bank\Services\Contracts\BankServiceContract;
use WebAppId\Bank\Services\Requests\BankServiceRequest;
use WebAppId\Bank\Services\Responses\BankServiceResponse;
use WebAppId\Bank\Services\Responses\BankServiceResponseList;
use WebAppId\DDD\Services\BaseService;
use WebAppId\DDD\Tools\Lazy;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankService
 * @package WebAppId\Bank\Services
 */
class BankService extends BaseService implements BankServiceContract
{

    /**
     * @inheritDoc
     */
    public function store(BankServiceRequest $bankServiceRequest, BankRepositoryRequest $bankRepositoryRequest, BankRepository $bankRepository, BankServiceResponse $bankServiceResponse): BankServiceResponse
    {
        $bankRepositoryRequest = Lazy::copy($bankServiceRequest, $bankRepositoryRequest, Lazy::AUTOCAST);

        $result = $this->container->call([$bankRepository, 'store'], ['bankRepositoryRequest' => $bankRepositoryRequest]);
        if ($result != null) {
            $bankServiceResponse->status = true;
            $bankServiceResponse->message = 'Store Data Success';
            $bankServiceResponse->bank = $result;
        } else {
            $bankServiceResponse->status = false;
            $bankServiceResponse->message = 'Store Data Failed';
        }

        return $bankServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, BankServiceRequest $bankServiceRequest, BankRepositoryRequest $bankRepositoryRequest, BankRepository $bankRepository, BankServiceResponse $bankServiceResponse): BankServiceResponse
    {
        $bankRepositoryRequest = Lazy::copy($bankServiceRequest, $bankRepositoryRequest, Lazy::AUTOCAST);

        $result = $this->container->call([$bankRepository, 'update'], ['id' => $id, 'bankRepositoryRequest' => $bankRepositoryRequest]);
        if ($result != null) {
            $bankServiceResponse->status = true;
            $bankServiceResponse->message = 'Update Data Success';
            $bankServiceResponse->bank = $result;
        } else {
            $bankServiceResponse->status = false;
            $bankServiceResponse->message = 'Update Data Failed';
        }

        return $bankServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, BankRepository $bankRepository, BankServiceResponse $bankServiceResponse): BankServiceResponse
    {
        $result = $this->container->call([$bankRepository, 'getById'], ['id' => $id]);
        if ($result != null) {
            $bankServiceResponse->status = true;
            $bankServiceResponse->message = 'Data Found';
            $bankServiceResponse->bank = $result;
        } else {
            $bankServiceResponse->status = false;
            $bankServiceResponse->message = 'Data Not Found';
        }

        return $bankServiceResponse;
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, BankRepository $bankRepository): bool
    {
        return $this->container->call([$bankRepository, 'delete'], ['id' => $id]);
    }

    /**
     * @inheritDoc
     */
    public function get(BankRepository $bankRepository, BankServiceResponseList $bankServiceResponseList, int $length = 12, string $q = null): BankServiceResponseList
    {
        $result = $this->container->call([$bankRepository, 'get'], ['q' => $q]);
        if (count($result) > 0) {
            $bankServiceResponseList->status = true;
            $bankServiceResponseList->message = 'Data Found';
            $bankServiceResponseList->bankList = $result;
            $bankServiceResponseList->count = $this->container->call([$bankRepository, 'getCount']);
            $bankServiceResponseList->countFiltered = $this->container->call([$bankRepository, 'getCount'], ['q' => $q]);
        } else {
            $bankServiceResponseList->status = false;
            $bankServiceResponseList->message = 'Data Not Found';
        }
        return $bankServiceResponseList;
    }

    /**
     * @inheritDoc
     */
    public function getCount(BankRepository $bankRepository, string $q = null): int
    {
        return $this->container->call([$bankRepository, 'getCount'], ['q' => $q]);
    }
}
