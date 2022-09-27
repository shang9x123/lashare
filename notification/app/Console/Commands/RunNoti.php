<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class RunNoti extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noti:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Chay Notification';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::find(1);
        foreach ($user->unreadNotifications as $notification) {
            echo ( $notification->id);
        }
        $user->notify((new InvoicePaid())->delay(Carbon::now()->addSeconds(20)));
        return 0;
    }
}
