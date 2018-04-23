<?php

/**
 * Created by PhpStorm
 * User: jrodri
 * Date: 2018-04-23
 * Time: 12:22 AM
 */
class BookAPI
{
    private $api_key;

    public function __construct()
    {
        $this->api_key = 'c0518fd813184d81a4570821eba20a2f';
    }


    private function doQuery($call, $params = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $query = array(
            "api-key" => $this->api_key
        );
        if ($params){
            $query = array_merge($query, $params);
        }
        curl_setopt($curl, CURLOPT_URL,
            $call . "?" . http_build_query($query)
        );
        $result = json_decode(curl_exec($curl));
        return $result;
    }


    private function validateResult($result){
        if (!isset($result->status)){
            return false;
        }

        if ($result->status === "OK"){
            return $result->results;
        }else{
            return false;
        }
    }

    public function getLists($params = null){

        if (!$params) {
            $params = [
                "list-name" => "hardcover-fiction",
                "published-date" => "2018-01-17",
                "rank" => "1"
            ];
        }

        $result = $this->doQuery("https://api.nytimes.com/svc/books/v3/lists//.json", $params);

        return $this->validateResult($result);
    }


}