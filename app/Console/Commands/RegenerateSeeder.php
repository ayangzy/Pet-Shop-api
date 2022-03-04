<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class RegenerateSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seeder:regenerate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command truncate and re-seed the database everyday at midnight UTC.';

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
     * @return int
     */
    public function handle()
    {
        $this->truncateDb();
        $this->seedDb();
    }


    /**
     * @return bool
     */
    private function truncateDb(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('orders')->truncate();
        DB::table('payments')->truncate();
        DB::table('order_statuses')->truncate();
        DB::table('users')->where('is_admin', 0)->delete();
        DB::table('files')->truncate();
        DB::table('categories')->truncate();
        DB::table('brands')->truncate();
        DB::table('products')->truncate();

        Schema::enableForeignKeyConstraints();
    }

    /**
     * @return bool
     */
    private function seedDb(): bool
    {
        return Artisan::call("db:seed");
    }
}
