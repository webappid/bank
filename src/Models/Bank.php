<?php
/**
 * Created by LazyCrud - @DyanGalih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @author: Dyan Galih<dyan.galih@gmail.com>
 * Date: 17:31:01
 * Time: 2020/07/26
 * Class Bank
 * @package WebAppId\Bank\Models
 */
class Bank extends Model
{
    protected $table = 'banks';
    protected $fillable = ['id', 'code', 'name', 'status'];
    protected $hidden = ['created_at', 'updated_at'];
}
