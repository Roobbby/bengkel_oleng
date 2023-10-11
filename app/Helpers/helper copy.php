<?php   
            $data = array(
                "device_key" => 'qSkH1Ddnye4oYtQUSItHFy1gP2empXpmXgemEURk',
                "data" => array(
                    array(
                        "phone" => 6281329749033,
                        "message" =>'hai apa kabar ini pesan baru',
                        "delay" => 10
                    )
                )
            );
            

$curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "http://154.26.137.255:8080/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => [
                "Content-Type: application/json",
                "email: rias@gmail.com",
                "token: QjV6T3F91KC4D2F8XUzOLhcM06Nc7fdp0MFomAq197gwVMXsRxRsd"
            ],
            ]);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
            return json_decode($response);
        }
?>