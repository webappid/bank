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

class BankSearchRequest extends AbstractFormRequest
{
    function rules():array
    {
        return [
            'q' => 'string|nullable|max:255',
            'search' => 'array|nullable|max:255',
        ];
    }
}
