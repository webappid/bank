<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Repositories\Contracts;

use WebAppId\Bank\Models\Bank;
use WebAppId\Bank\Repositories\Requests\BankRepositoryRequest;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankRepositoryContract
 * @package WebAppId\Bank\Repositories\Contracts
 */
interface BankRepositoryContract
{
    /**
     * @param BankRepositoryRequest $bankRepositoryRequest
     * @param Bank $bank
     * @return Bank|null
     */
    public function store(BankRepositoryRequest $bankRepositoryRequest, Bank $bank): ?Bank;

    /**
     * @param int $id
     * @param BankRepositoryRequest $bankRepositoryRequest
     * @param Bank $bank
     * @return Bank|null
     */
    public function update(int $id, BankRepositoryRequest $bankRepositoryRequest, Bank $bank): ?Bank;

    /**
     * @param int $id
     * @param Bank $bank
     * @return Bank|null
     */
    public function getById(int $id, Bank $bank): ?Bank;

    /**
     * @param string $code
     * @param Bank $bank
     * @return Bank|null
     */
    public function getByCode(string $code, Bank $bank): ?Bank;

    /**
     * @param int $id
     * @param Bank $bank
     * @return bool
     */
    public function delete(int $id, Bank $bank): bool;

    /**
     * @param Bank $bank
     * @param int $length
     * @param string $q
     * @return LengthAwarePaginator
     */
    public function get(Bank $bank, int $length = 12, string $q = null): LengthAwarePaginator;

    /**
     * @param Bank $bank
     * @return int
     * @param string $q
     */
    public function getCount(Bank $bank, string $q = null): int;

}
