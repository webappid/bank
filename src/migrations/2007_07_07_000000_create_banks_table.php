<?php
/**
 * @author Dyan Galih <dyan.galih@gmail.com>
 * @copyright 2018 WebAppId
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
/**
 * Run the migrations.
 *
 * @return void
 */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id')
                ->comment('Table banks references');
            $table->string('code')
                ->index()
                ->unique()
                ->comment('Bank code');
            $table->string('name')
                ->index()
                ->comment('Bank name');
            $table->enum('status',['y','n'])
                ->comment('Bank status');
        
            $table->timestamps();

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
