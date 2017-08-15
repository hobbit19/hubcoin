<?php

class tweet_bot
{
    function oauth()
    {
        require_once("twitteroauth.php");
        $con = new TwitterOAuth($this->api_key, $this->api_secret, $this->access_token, $this->access_token_secret);
        return $con;
    }
    function tweet($text)
    {
        $con = $this->oauth();
        $status = $con->post('statuses/update', array('status' => $text));
        return $status;
    }
    function setKey($api_key,$api_secret,$access_token,$access_token_secret)
    {
        $this->api_key = $api_key;
        $this->api_secret = $api_secret;
        $this->access_token = $access_token;
        $this->access_token_secret = $access_token_secret;
    }
}
class bird
{


    function twe($text)
    {
        $api_key= 'TBXF2VNOtCJK0IMhDCxYZyaRM';
        $api_secret= 'gXYobZMlWZ6QamG2oSFsFdjcAQeud2bchTjU6Ij14T4Cj9iH80';
        $access_token = '894924405050155008-CtJepslf0T31bGDw0UbvdKmTTi2dy5X' ;
        $access_token_key= 'oZLISwUILVtu7HEKSyn4SMBw3l9IdVpQDEcayJxz4kt4Z';
        $tweet= new tweet_bot;
        $tweet->setKey($api_key, $api_secret,$access_token , $access_token_key);
        $result = $tweet->tweet($text);
        Print_r($result); 
    }
}