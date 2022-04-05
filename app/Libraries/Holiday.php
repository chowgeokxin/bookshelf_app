<?php


namespace App\Libraries;


use Illuminate\Support\Facades\Log;

class Holiday
{
    protected $endpoint;
    protected $url;
    protected $method;
    protected $post_fields;
    protected $api_key;
    private $ssl = false;

    public function __construct()
    {
        $this->endpoint = "https://clients6.google.com/calendar/v3/calendars/en.malaysia%23holiday@group.v.calendar.google.com/events?calendarId=en.malaysia%23holiday%40group.v.calendar.google.com&singleEvents=true&timeZone=Asia%2FKuala_Lumpur&maxAttendees=1&maxResults=250&sanitizeHtml=true";
        $this->api_key = "AIzaSyBNlYH01_9Hc5S1J9vuFmu2nUqBZJNAXxs"; // old api key : AIzaSyDL5V7HPB1UYjtuW5dAa3Zp4SItZUr3MZc
        if (env("APP_ENV")=="production") {
            $this->ssl = true;
        }
    }

    private function send()
    {
        $status = 0;
        $error_message = "";
        $headers = [
            'Content-Type:application/json'
        ];
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, $this->ssl);
        if ($this->method == "POST") {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($this->post_fields));
        }
        $responses = curl_exec($curl);
        Log::debug($responses);
        $arr_responses=[];
        if ($responses === false) {
            $error_message = 'Curl error: ' . curl_error($curl);
        } else {
            $arr_responses = json_decode($responses, true);
            if (isset($arr_responses['error'])) {
                $error_message = $arr_responses['error']["message"];
            } else {
                $arr_responses = $arr_responses["items"];
                $status = 1;
            }
        }
        curl_close($curl);
        return ["result"=>$status, "error_message"=>$error_message, "response"=>$arr_responses];
    }

    public function getHolidays() {
        $this->method = "GET";
        $this->url = $this->endpoint."&key=".$this->api_key;
        $response = $this->send();
        return $response;
    }
}
