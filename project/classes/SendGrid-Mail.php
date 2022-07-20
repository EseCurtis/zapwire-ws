<?php
    class SendGrid_Mail {
        function send($from, $to, $subject, $body, $type = "text/plain", $from_name = "Support") {
            global $app;

            $postfields = [
                "personalizations" => [
                    [
                        "to" => [
                            [
                                "email" => $to
                            ]
                        ],
                        "subject" => $subject
                    ]
                ],
                "from" => [
                    "email" => $from,
                    "name" => $from_name
                ],
                "content" => [
                    [
                        "type" => $type,
                        "value" => $body
                    ]
                ]
            ];

            $curl = curl_init();

            curl_setopt_array($curl, [
                CURLOPT_URL => "https://rapidprod-sendgrid-v1.p.rapidapi.com/mail/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($postfields),
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: rapidprod-sendgrid-v1.p.rapidapi.com",
                    "X-RapidAPI-Key: 2d186ce216msh1d00b63a4fd34d1p1655cfjsn1c7914542d9d",
                    "content-type: application/json"
                ],
            ]);

            //write the CURLOPT_POSTFIELDS AS PHP ARRAY 
            

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                return 0;
            } else {
                $response_json_error = (json_decode($response, TRUE))['errors'];

                if(count($response_json_error) < 1) {
                    return 1;
                } else {
                    return 0;
                }
            }

        }
    }
?>