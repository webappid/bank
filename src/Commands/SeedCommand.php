<?php
/**
 * @author Dyan Galih <dyan.galih@gmail.com>
 */

namespace WebAppId\Bank\Commands;

use Illuminate\Console\Command;

class SeedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webappid:bank:seed';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed database bank';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \Artisan::call('db:seed', ['--class' => 'WebAppId\Bank\Seeds\DatabaseSeeder']);
        $this->info('Seeded: WebAppId\Bank\Seeds\BankSeeder');
    }
}