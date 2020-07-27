<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Repositories;

use WebAppId\Bank\Models\Bank;
use WebAppId\Bank\Repositories\Contracts\BankRepositoryContract;
use WebAppId\Bank\Repositories\Requests\BankRepositoryRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use WebAppId\DDD\Tools\Lazy;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankRepository
 * @package App\Repositories
 */
class BankRepository implements BankRepositoryContract
{
    /**
     * @inheritDoc
     */
    public function store(BankRepositoryRequest $bankRepositoryRequest, Bank $bank): ?Bank
    {
        try {
            $bank = Lazy::copy($bankRepositoryRequest, $bank);
            $bank->save();
            return $bank;
        } catch (QueryException $queryException) {
            dd($queryException);
            report($queryException);
            return null;
        }
    }

    /**
     * @param Bank $bank
     * @param string|null $q
     * @return Builder
     */
    protected function getJoin(Bank $bank, string $q = null): Builder
    {
        return $bank
            ->when($q != null, function ($query) use ($q) {
                return $query->where('code', 'LIKE', '%' . $q . '%');
            });
    }

    /**
     * @return array
     */
    protected function getColumn(): array
    {
        return
            [
                'banks.id',
                'banks.code',
                'banks.name',
                'banks.status',
                'banks.created_at',
                'banks.updated_at'
            ];
    }

    /**
     * @inheritDoc
     */
    public function update(int $id, BankRepositoryRequest $bankRepositoryRequest, Bank $bank): ?Bank
    {
        $bank = $bank->find($id);
        if ($bank != null) {
            try {
                $bank = Lazy::copy($bankRepositoryRequest, $bank);
                $bank->save();
                return $bank;
            } catch (QueryException $queryException) {
                report($queryException);
            }
        }
        return $bank;
    }

    /**
     * @inheritDoc
     */
    public function getById(int $id, Bank $bank): ?Bank
    {
        return $this->getJoin($bank)->find($id, $this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getByCode(string $code, Bank $bank): ?Bank
    {
        return $this->getJoin($bank)->where('code', $code)->first($this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function delete(int $id, Bank $bank): bool
    {
        $bank = $this->getById($id, $bank);
        if ($bank != null) {
            return $bank->delete();
        } else {
            return false;
        }
    }

    /**
     * @inheritDoc
     */
    public function get(Bank $bank, int $length = 12, string $q = null): LengthAwarePaginator
    {
        return $this
            ->getJoin($bank, $q)
            ->paginate($length, $this->getColumn());
    }

    /**
     * @inheritDoc
     */
    public function getCount(Bank $bank, string $q = null): int
    {
        return $this
            ->getJoin($bank, $q)
            ->count();
    }
}
