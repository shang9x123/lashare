<?php

namespace App\Service;

use App\Jobs\AddMoneyToAccount;
use App\Models\Sms;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;

class APISMS
{

    public static function readsms($device_id, $last_id = 0)
    {
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization', env('SMS_API'));
        $api_client = new ApiClient($config);
        $messageClient = new MessageApi($api_client);
        $messages = $messageClient->searchMessages([
                'filters' => [
                    [
                        [
                            'field' => 'device_id',
                            'operator' => '=',
                            'value' => $device_id,
                        ],
                        [
                            'field' => 'status',
                            'operator' => '=',
                            //'value' => 'sent'
                            'value' => 'Received',
                        ],
                        [
                            'field' => 'id',
                            'operator' => '>',
                            //'value' => 'sent'
                            // 'value' => '186799770',
                            'value' => $last_id,
                        ],
                    ],

                ],
                'order_by' => [
                    [
                        'field' => 'created_at',
                        'direction' => 'ASC'
                        //'direction' => 'DESC'
                    ],
                    [
                        'field' => 'device_id',
                        'direction' => 'DESC'
                    ]
                ],
                'limit' => 15,
               // 'offset'  => 10
            ]
        );
        return $messages['results'];
        /*
        dd($messages);
        $return_data = null;
        foreach ($messages['results'] as $message) {
            $subject = $message['message'];
            if(preg_match("/Agribank/i",$subject,$match))
            {
                preg_match_all('/^(.+):\s(\+|-)(.+)VND\s\((.+)$/',$subject,$match);
                //dd($match);
                $sotien_string = $match[3];
                $array_thongtin = $match[4][0];
                $sotien = str_replace(',','',$sotien_string[0]);
                $return_data[]['sotien'] = $sotien;
                preg_match('/^(.+)\;(.+)\;(.+)\)\.(.+)$/',$array_thongtin,$match1);
                dd($sotien);

                $noidung_chuyenkhoan = $match1[3];
                $return_data[]['noidung'] = $noidung_chuyenkhoan;
            }
        }
        return $return_data;
        */
    }

    public static function transsms($sms_kitu = '',$user)
    {

        // truy v???n d??? li???u m?? ch??a x??? l?? v??o trong database v???i th???i gian c??ch 1 ti???ng tr?????c
        //$sms_return = Sms::where('message','LIKE','%'.$sms_kitu.'%')->get();
        $sms_return = DB::table('sms')->where([['message', 'LIKE', '%' . $sms_kitu . '%'], ['stautus_read_sms', 0],['created_at','>',Carbon::now()->subHours(1)]])
            ->get(['id', 'stautus_read_sms', 'message']);
        if(count($sms_return) > 0)
        {
            foreach ($sms_return as $key => $value) {
                $subject = $value->message;
                preg_match_all('/^(.+):\s(\+|-)(.+)VND\s\((.+)$/', $subject, $match);
                $sotien_string = $match[3];
                $array_thongtin = $match[4][0];
                $sotien = str_replace(',', '', $sotien_string[0]);
                $return_data['sotien'] = $sotien;
                preg_match('/^(.+)\).(.+)$/', $array_thongtin, $match1);
                $noidung_chuyenkhoan = $match1[1];
                // t??m ki???m chu???i trong n???i dung
                $search = strpos($noidung_chuyenkhoan,$user->name);
                if($search)
                {
                    $return_data['noidung'] = $noidung_chuyenkhoan;
                    $return_data['id'] = $value->id;
                    $return_data['to'] = $user->id;
                    //x??? l?? d??? li???u n???p ti???n v??o t??i kho???n
                    AddMoneyToAccount::dispatch($return_data);
                }

            }
            return 1;
        }
        else{
            return 0;
        }

    }
}
