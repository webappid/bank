<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Services\Contracts;

use WebAppId\Bank\Repositories\BankRepository;
use WebAppId\Bank\Repositories\Requests\BankRepositoryRequest;
use WebAppId\Bank\Services\Requests\BankServiceRequest;
use WebAppId\Bank\Services\Responses\BankServiceResponse;
use WebAppId\Bank\Services\Responses\BankServiceResponseList;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankServiceContract
 * @package App\Services\Contracts
 */
interface BankServiceContract
{
    /**
     * @param BankServiceRequest $bankServiceRequest
     * @param BankRepositoryRequest $bankRepositoryRequest
     * @param BankRepository $bankRepository
     * @param BankServiceResponse $bankServiceResponse
     * @return BankServiceResponse
     */
    public function store(BankServiceRequest $bankServiceRequest, BankRepositoryRequest $bankRepositoryRequest, BankRepository $bankRepository, BankServiceResponse $bankServiceResponse): BankServiceResponse;

    /**
     * @param int $id
     * @param BankServiceRequest $bankServiceRequest
     * @param BankRepositoryRequest $bankRepositoryRequest
     * @param BankRepository $bankRepository
     * @param BankServiceResponse $bankServiceResponse
     * @return BankServiceResponse
     */
    public function update(int $id, BankServiceRequest $bankServiceRequest, BankRepositoryRequest $bankRepositoryRequest, BankRepository $bankRepository, BankServiceResponse $bankServiceResponse): BankServiceResponse;

    /**
     * @param int $id
     * @param BankRepository $bankRepository
     * @param BankServiceResponse $bankServiceResponse
     * @return BankServiceResponse
     */
    public function getById(int $id, BankRepository $bankRepository, BankServiceResponse $bankServiceResponse): BankServiceResponse;

    /**
     * @param string $code
     * @param BankRepository $bankRepository
     * @param BankServiceResponse $bankServiceResponse
     * @return BankServiceResponse
     */
    public function getByCode(string $code, BankRepository $bankRepository, BankServiceResponse $bankServiceResponse): BankServiceResponse;

    /**
     * @param int $id
     * @param BankRepository $bankRepository
     * @return bool
     */
    public function delete(int $id, BankRepository $bankRepository): bool;

    /**
     * @param string $q
     * @param BankRepository $bankRepository
     * @param BankServiceResponseList $bankServiceResponseList
     * @param int $length
     * @return BankServiceResponseList
     */
    public function get(BankRepository $bankRepository, BankServiceResponseList $bankServiceResponseList, int $length = 12, string $q = null): BankServiceResponseList;

    /**
     * @param string $q
     * @param BankRepository $bankRepository
     * @return int
     */
    public function getCount(BankRepository $bankRepository, string $q = null): int;
}
