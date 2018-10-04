<?php
namespace WebAppId\Bank\Tests\Unit\Models;

use WebAppId\Bank\Models\Bank;
use WebAppId\Bank\Tests\TestCase;

class BankTest extends TestCase
{
    private $bank;

    public function setUp()
    {   
        $this->bank = new Bank();
        parent::setUp();
    }

    public function testGetAll(){
        $bank = $this->bank->getAllBank();
        if(count($bank)>0){
            $this->assertTrue(true);
        }else{
            $this->assertTrue(false);
        }
    }
    
}
