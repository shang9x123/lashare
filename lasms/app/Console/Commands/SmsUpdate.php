<?php

namespace App\Console\Commands;

use App\Models\Sms;
use App\Service\APISMS;
use Illuminate\Console\Command;

class SmsUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sms:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update sms từ server smsgateway về database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $deviced_id = 129188;
        $last_sms = Sms::latest('id')->first();
        // nếu có dữ liệu trong bảng sms
        if($last_sms)
        {
            $return_data = APISMS::readsms($deviced_id,$last_sms['id_sms']);
            foreach ($return_data as $return_datum) {
                $data_input['id_sms'] = $return_datum['id'];
                $data_input['deviceId'] = $return_datum['deviceId'];
                $data_input['message'] = $return_datum['message'];
                $data_input['status'] = $return_datum['status'];
                $result_create = Sms::create($data_input);
            }
        }
        else
        {
            $return_data = APISMS::readsms($deviced_id);
            foreach ($return_data as $return_datum) {

                $data_input['id_sms'] = $return_datum['id'];
                $data_input['deviceId'] = $return_datum['deviceId'];
                $data_input['message'] = $return_datum['message'];
                $data_input['status'] = $return_datum['status'];
                $result_create = Sms::create($data_input);
            }
        }
        return 0;
    }
}
