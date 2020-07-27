<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Requests;

use WebAppId\DDD\Requests\AbstractFormRequest;
/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class BankService
 * @package App\Requests
 */

class BankRequest extends AbstractFormRequest
{
    /**
     * @inheritDoc
     */
    function rules(): array
    {
        return [
            'code' => 'string|required|max:255',
            'name' => 'string|required|max:255',
            'status' => 'string|required|max:1'
         ];
    }
}
