<?php
/*
    Author: yandricr
    API: https://lazy-blue-elk-hat.cyclic.cloud/
    Docs: https://gpti.projectsrpp.repl.co/
*/

namespace gpti;
use Exception;

error_reporting(0);

class gpt {
    private $res = null;
    private $err = null;

    public function __construct($json = ""){
        $api = "https://lazy-blue-elk-hat.cyclic.cloud";
        $doc = "https://gpti.projectsrpp.repl.co/";

        $prompt = null;
        $model = null;
        $type = null;
        
        try {
            if(is_object(json_decode($json))){
                $json = json_decode($json);
                if(!empty($json->prompt)){
                    $prompt = $json->prompt;
                }

                if(!empty($json->model)){
                    $model = $json->model;
                }

                if(!empty($json->type)){
                    $type = $json->type;
                }
            }
        } catch(Exception $e){
            $prompt = null;
            $model = null;
        }

        if($prompt == null || $model == null){
            $js = array(
                "api" => "gpti",
                "code" => 400,
                "status" => false,
                "message" => "error",
                "doc" => $doc
            );
            $this->err = json_decode(json_encode($js));
        } else {
            try {
                $url = $api."/gpti";
                $data = array(
                    "prompt" => $prompt,
                    "model" => $model,
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
                        "api" => "gpti",
                        "code" => 400,
                        "status" => false,
                        "message" => "error",
                        "doc" => $doc
                    );
                    $this->err = json_decode(json_encode($js));
                } else {
                    if(!empty($type) && $type == "text"){
                        $this->res = $response;
                    } else {
                        $js = json_decode($response);
                        $this->res = $js;
                    }
                }
            } catch(Exception $e){
                $js = array(
                    "api" => "gpti",
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
        if($this->res == null){
            return null;
        } else {
            return $this->res;
        }
    }

    public function error(){
        if($this->err == null){
            return null;
        } else {
            return $this->err;
        }
    }
}
?>