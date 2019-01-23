<?php

//url aquispe
define('URL_SITIO', 'http://localhost/conferencia');

require 'paypal/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'Ab6FjXsw21romL3sUNcJ9rEuFwZRZ1DNLMPPbanLIoHq5MAOU9boiYPOiXXxXNYCzDPYpAAhQUfmFfeC',     // ClientID
        'EAxPy8Vd2FgpqdWP4H6pg19WBm74jafcMENKmVVqpcSLlwxTQne3rlkxNhxtoinAVB4RYvQyS703n1gS'      // ClientSecret
    )
);
