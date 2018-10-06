<?php
namespace WebAppId\Bank\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\QueryException;

class Bank extends Model
{
    protected $table = 'banks';

    protected $hidden = ['created_at', 'updated_at'];

    protected $fillable = ['id', 'code', 'name'];

    /**
     * Add Bank
     *
     * @param Request $request
     * @return boolean/object
     */
    public function addBank($request)
    {

        try {
            $bank = new self();
            $bank->code = $request->code;
            $bank->name = $request->name;
            $bank->status = $request->status;
            $bank->save();
            return $bank;
        } catch (QueryException $e) {
            report($e);
            return false;
        }
    }

    /**
     * Update Bank By Code
     *
     * @param Request $request
     * @param String $code
     * @return Object
     */
    public function updateBankByCode($request, $code)
    {
        $bankData = $this->getBank($code);
        return $this->updateBank($bankData, $request);
    }

    /**
     * Update Bank By Id
     *
     * @param Request $request
     * @param Integer $id
     * @return Bank
     */
    public function updateBankById($request, $id)
    {
        $bankData = $this->getBankById($id);
        return $this->updateBank($bankData, $request);
    }

    /**
     * Update Bank
     *
     * @param Bank $bank
     * @param Request $request
     * @return Bank
     */
    private function updateBank($bank, $request){
        if ($bank != null) {
            $bank->code = $request->code;
            $bank->name = $request->name;
            $bank->status = $request->status;
            $bank->save();
            return $bank;
        }
        return false;
    }

    /**
     * Get Bank By Code
     *
     * @param String $code
     * @return List Of Bank
     */
    public function getBank($code)
    {
        return $this->where('code', $code)->first();
    }

    /**
     * Get Bank By Id
     *
     * @param String $code
     * @return List Of Bank
     */
    public function getBankById($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * getAllBank
     *
     * @return List Of Bank
     */
    public function getAllBank()
    {
        return $this->get();
    }

    /**
     * Delete bank by code
     *
     * @param String $code
     * @return boolean
     */
    public function deleteBankBy($code)
    {
        try {
            $this->where('code', $code)->delete();
            return true;
        } catch (QueryException $e) {
            report($e);
            return false;
        }
    }

}