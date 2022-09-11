<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Service\APISMS;
use Illuminate\Console\Command;

class SmsTrans extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:trans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cộng tiền cho người dùng khi nạp thành công';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // lấy tất cả người dùng
        $alluser = User::all();
        foreach ($alluser as $user) {
            // sau đó kiểm tra dựa trên name
            $data = APISMS::transsms('Agribank',$user);
            return $data;
        }
    }
}
