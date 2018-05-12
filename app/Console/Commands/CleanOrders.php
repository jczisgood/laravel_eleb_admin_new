<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CleanOrders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //
        set_time_limit(0);
        while (1){
            DB::table('orders')->where([
                ['order_status','0'],
                ['created_at','<',date('Y-m-d H:i:s',strtotime('-1 day'))]
            ])->update(['order_status'=>'2']);
            echo mb_convert_encoding('清理成功','gbk','utf-8').date('Y-m-d H:i:s')."\n";
            sleep(3);
        }
    }
}
