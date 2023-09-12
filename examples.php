<?php
/*
    Author: yandricr
    API: https://gpti.projectsrpp.repl.co/api
    Docs: https://gpti.projectsrpp.repl.co/
*/

include "./vendor/autoload.php";

use \gpti\gpt;
use \gpti\prodia;
use \gpti\lexica;
use \gpti\dalle;
use \gpti\util;


/* util model gpt and prodia */
$util = new util();

$gptModel = $util->gptModel();
echo(json_encode($gptModel));

$prodiaModel = $util->prodiaModel();
echo(json_encode($prodiaModel));

$prodiaSampler = $util->prodiaSampler();
echo(json_encode($prodiaSampler));
/* util model gpt and prodia */


/* gpt */
$json = json_encode(array(
    "prompt" => "hello gpt, tell me what your version is?",
    "model" => "1",                          // code model
    "type" => "json"                         // optional: "json", "markdown" or "text"
));

$gpt = new gpt($json);
$response = $gpt->response();
$error = $gpt->error();
if($error != null){
    echo(json_encode($error));
} else {
    echo(json_encode($response));
}
/* gpt */


/* prodia */
$json = json_encode(array(
    "prompt" => "colorful reflections on the calm river",
    "model" => 1,                           // code model
    "sampler" => 1,                         // code sampler
    "steps" => "25",                        // 1-3
    "cfg_scale" => "7",                     // 0-20
    "negative_prompt" => "",                // optional
    "type" => "json"                        // optional: "json" or "text"
));

$prodia = new prodia($json);
$response = $prodia->response();
$error = $prodia->error();
if($error != null){
    echo(json_encode($error));
} else {
    echo(json_encode($response));
}
/* prodia */


/* lexica */
$json = json_encode(array(
    "prompt" => "tranquil sunset over the mountains",
    "type" => "json"                        // optional: "json" or "text"
));

$lexica = new lexica($json);
$response = $lexica->response();
$error = $lexica->error();
if($error != null){
    echo(json_encode($error));
} else {
    echo(json_encode($response));
}
/* lexica */


/* dalle */
$json = json_encode(array(
    "prompt" => "starry sky over the city",
    "type" => "json"                        // optional: "json" or "text"
));

$dalle = new dalle($json);
$response = $dalle->response();
$error = $dalle->error();
if($error != null){
    echo(json_encode($error));
} else {
    echo(json_encode($response));
}
/* dalle */
?>