<?php 

class Mailer{

      public function mg_send($to, $subject, $message) 
      {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($ch, CURLOPT_USERPWD, 'api:'.'key-9e45b4f77e6254e3d8de5c852541d542');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $plain = strip_tags(nl2br($message));

            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandboxa3c9cd9daa924c39a31827f1e23423ba.mailgun.org/messages');
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('from' => 'support@sandboxa3c9cd9daa924c39a31827f1e23423ba.mailgun.org',
                  'to' => $to,
                  'subject' => $subject,
                  'html' => $message,
                  'text' => $plain));

            $j = json_decode(curl_exec($ch));

            $info = curl_getinfo($ch);

            print_r($info);
            
            if($info['http_code'] != 200)
                  die('Error!');

            curl_close($ch);

            return $j;
      }

}