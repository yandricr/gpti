<?php
/*
    Author: yandricr
    API: https://gpti.projectsrpp.repl.co/api
    Docs: https://gpti.projectsrpp.repl.co/
*/

namespace gpti;
use Exception;

error_reporting(0);

class dalle {
    private $res = null;
    private $err = null;

    public function __construct($json = ""){
        $api = "https://gpti.projectsrpp.repl.co/api";
        $doc = "https://gpti.projectsrpp.repl.co/";

        $prompt = null;
        $type = null;
        
        try {
            if(is_object(json_decode($json))){
                $json = json_decode($json);
                if(!empty($json->prompt)){
                    $prompt = $json->prompt;
                }

                if(!empty($json->type)){
                    $type = $json->type;
                }
            } else {
                $prompt = null;
            }
        } catch(Exception $e){
            $prompt = null;
        }

        if($prompt == null){
            $js = array(
                "api" => "dalleai",
                "code" => 400,
                "status" => false,
                "message" => "error",
                "doc" => $doc
            );
            $this->err = json_decode(json_encode($js));
        } else {
            try {
                $url = $api."/dalleai";
                $data = array(
                    "prompt" => $prompt,
                    "type" => $type != null ? $type : ""
                );

                $options = array(
                    "http" => array(
                        "header"  => "Content-type: application/json",
                        "method"  => "POST",
                        "content" => json_encode($data)
                    )
                );

                $context  = stream_context_create($options);
                $response = @file_get_contents($url, false, $context);

                if ($response === false) {
                    $js = array(
                        "api" => "dalleai",
                        "code" => 400,
                        "status" => false,
                        "message" => "error",
                        "doc" => $doc
                    );
                    $this->err = json_decode(json_encode($js));
                } else {
                    $xs = json_decode($response);
                    if(!empty($xs->status) && $xs->status == true){
                        if($type != null && strtolower($type) == "text"){
                            $this->res = $response;
                        } else {
                            $this->res = $xs;
                        }
                    } else {
                        $js = array(
                            "api" => "dalleai",
                            "code" => 400,
                            "status" => false,
                            "message" => "error",
                            "doc" => $doc
                        );
                        $this->err = json_decode(json_encode($js));
                    }
                }
            } catch(Exception $e){
                $js = array(
                    "api" => "dalleai",
                    "code" => 400,
                    "status" => false,
                    "message" => "error",
                    "doc" => $doc
                );
                $this->err = json_decode(json_encode($js));
            }
        }
    }

    public function response(){
        if($this->res != null){
            return $this->res;
        } else {
            return null;
        }
    }

    public function error(){
        if($this->err != null){
            return $this->err;
        } else {
            return null;
        }
    }
}
?>