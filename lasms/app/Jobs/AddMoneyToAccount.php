<?php

namespace App\Jobs;

use App\Models\Sms;
use App\Models\Tran;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class AddMoneyToAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $return_data;
    public function __construct($return_data)
    {
        $this->return_data = $return_data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $input['from'] = 0;
        $input['to'] = $this->return_data['to'];
        $input['amount'] = $this->return_data['sotien'];
        $input['before_transaction'] = 0;
        $input['source'] = 0;
        $input['id_sms'] = $this->return_data['id'];
        $input['content'] = 'Nạp tiền vào tài khoản qua bank ';
        $tatus = DB::transaction(function () use ($input)
        {
            // tự động tăng tiền lên khi nạp tiền vào
            User::where('id',$input['to'])->increment('coin', $input['amount']);
            Tran::create($input);
            DB::table('sms')->where('id',$this->return_data['id'])->update(['stautus_read_sms'=>1]);
        },5);
        return $tatus;
    }
}
