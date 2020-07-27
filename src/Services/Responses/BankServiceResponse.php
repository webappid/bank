<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Services\Responses;

use WebAppId\Bank\Models\Bank;
use WebAppId\DDD\Responses\AbstractResponse;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankServiceResponse
 * @package WebAppId\Bank\Services\Responses
 */
class BankServiceResponse extends AbstractResponse
{
    /**
     * @var Bank
     */
    public $bank;
}
