<?php
namespace App\Service;
use Illuminate\Support\Carbon;
use SMSGatewayMe\Client\Api\MessageApi;
use SMSGatewayMe\Client\ApiClient;
use SMSGatewayMe\Client\Configuration;

class APISMS {

    public static function readsms($device_id)
    {
        $config = Configuration::getDefaultConfiguration();
        $config->setApiKey('Authorization',env('SMS_API'));
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
                            'value' => '186799770',
                        ],
                    ],

                ],
                'order_by' => [
                    [
                        'field' => 'created_at',
                        'direction' => 'DESC'
                    ],
                    [
                        'field' => 'device_id',
                        'direction' => 'DESC'
                    ]
                ],
                'limit'   => 15,
                // 'offset'  => 5
            ]
        );
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
    }
}
