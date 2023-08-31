
# GPTI

This package simplifies your interaction with various GPT models, eliminating the need for tokens or other methods to access GPT. It also allows you to use three artificial intelligences to generate images: DALL·E, Prodia, and Lexica, all of this without restrictions or limits


## Installation

You can install the package via Composer

```bash
  composer require yandricr/gpti
```
## Usage GPT

```php
include "./vendor/autoload.php";

use \gpti\gpt;

$json = json_encode(array(
    "prompt" => "hello gpt, tell me what your version is?",
    "model" => "1",                          // code model required
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
```

#### JSON

```json
{
    "api": "gpti",
    "code": 200,
    "status": true,
    "model": {
        "code": 1,
        "type": "gpt-4"
    },
    "gpt": "Hello there! I'm GPT-4, the fourth version of the Generative Pre-trained Transformer (GPT) model. As an AI language model, I'm designed to generate human-like text based on the given inputs and previous context. I'm constantly trained on vast amounts of text data from the internet, books, and other sources to improve my understanding and generate more accurate responses. How can I assist you today?"
}
```

#### Models

| Code | Model |
|--------------|--------------|
| 1 | gpt-4 |
| 2 | gpt-4-0613 |
| 3 | gpt-4-32k |
| 4 | gpt-4-0314 |
| 5 | gpt-4-32k-0314 |
| 6 | gpt-3.5-turbo |
| 7 | gpt-3.5-turbo-16k |
| 8 | gpt-3.5-turbo-0613 |
| 9 | gpt-3.5-turbo-16k-0613 |
| 10 | gpt-3.5-turbo-0301 |
| 11 | text-davinci-003 |
| 12 | text-davinci-002 |
| 13 | code-davinci-002 |
| 14 | gpt-3 |
| 15 | text-curie-001 |
| 16 | text-babbage-001 |
| 17 | text-ada-001 |
| 18 | davinci |
| 19 | curie |
| 20 | babbage |
| 21 | ada |
| 22 | babbage-002 |
| 23 | davinci-002 |

## Usage DALL·E

```php
include "./vendor/autoload.php";

use \gpti\dalle;

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
```

#### JSON

```json
{
    "api": "dalleai",
    "code": 200,
    "status": true,
    "prompt": "starry sky over the city",
    "ul": "https://..."
}
```
## Usage Lexica

```php
include "./vendor/autoload.php";

use \gpti\lexica;

$json = json_encode(array(
    "prompt" => "the sky is dyed with soft tones as the sun bids farewell",
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
```

#### JSON

```json
{
    "api": "lexicaai",
    "code": 200,
    "status": true,
    "prompt": "the sky is dyed with soft tones as the sun bids farewell",
    "images": [
        {
            "ul": "https://..."
        },
        {
            "ul": "https://..."
        },
        ...
    ]
}
```
## Usage Prodia

```php
include "./vendor/autoload.php";

use \gpti\prodia;

$json = json_encode(array(
    "prompt" => "the sun bids farewell in a warm sky, painting soft colors as the clouds dance",
    "model" => 1,                           // code model required
    "sampler" => 1,                         // code sampler required
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
```

#### JSON

```json
{
    "api": "prodiaai",
    "code": 200,
    "status": true,
    "model": {
        "model": {
            "code": 25,
            "type": "Realistic_Vision_V5.0.safetensors [614d1063]",
            "name": "Realistic Vision V5.0"
        },
        "sampler": {
            "code": 1,
            "type": "Euler",
        }
        "steps": 25,
        "cfg_scale": 7,
        "prompt": "the sun bids farewell in a warm sky, painting soft colors as the clouds dance",
        "negative_prompt": ""
    },
    "ul": "https://..."
}
```
## API Reference

Currently, the [API](https://lazy-blue-elk-hat.cyclic.cloud/) has no access restrictions or usage limits.

For more details and examples, refer to the complete [documentation](https://gpti.projectsrpp.repl.co/)

### Success 
The API can return the following success response code:

- **200** OK: The request was successful, and the response data is provided.

### Errors
The API can return the following error codes:

- **400** Bad Request: Incorrect or insufficient parameters.
- **404** Not Found: The requested resource was not found.
