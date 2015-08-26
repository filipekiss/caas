<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/info', function () use ($app) {
  return $_SERVER['HTTP_USER_AGENT'];
});

$app->get('/', function () use ($app) {
    if (stristr($_SERVER['HTTP_USER_AGENT'], "curl")) {
      return 'Hey! Please, try using /cpf or /cnpj endpoints. :)';
    }
    return "<!DOCTYPE html>
          <html>
          <head>
              <title>Lumen</title>

              <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

              <style>
                  body {
                      margin: 0;
                      padding: 0;
                      width: 100%;
                      height: 100%;
                      color: #B0BEC5;
                      display: table;
                      font-weight: 100;
                      font-family: 'Lato';
                  }

                  .container {
                      text-align: center;
                      display: table-cell;
                      vertical-align: middle;
                  }

                  .content {
                      text-align: center;
                      display: inline-block;
                      font-size: 18px
                  }

                  .title {
                      font-size: 48px;
                      margin-bottom: 40px;
                  }

                  .quote {
                      font-size: 24px;
                  }
                  
                  code {
                    display: block;
                    text-align: left;
                    padding: 10px;
                    background: #002B36;
                    color: #1BA198;
                  }
              </style>
          </head>
          <body>
              <div class=\"container\">
                  <div class=\"content\">
                      <div class=\"title\">
                        CPF as a Service
                      </div>
                      <div class=\"quote\">
                        Easy document numbers for testing applications.
                      </div>
                      <p>
                        Endpoints available:
                      </p>
                      <p>
                        <code>curl http://d.beij.in/cpf</code>
                        <code>$ 45026334024</code>
                      </p>
                      <p>
                        <code>curl http://d.beij.in/cnpj</code>
                        <code>$ 20361743000102</code>
                      </p>
                      <p>
                        Add a second parameter to receive it formatted
                      </p>
                      <p>
                        <code>
                          curl http://d.beij.in/cpf/s
                        </code>
                        <code>$ 582.578.136-64</code>
                      </p>
                      <p>
                        <code>
                          http://d.beij.in/cnpj/s
                        </code>
                        <code>$ 42.177.679/0001-39</code>
                      </p>
                  </div>
              </div>
          </body>
          </html>
      ";
});

$app->get('/cpf', 'Controller@generateCpf');
$app->get('/cpf/{formatted}', 'Controller@generateCpf');
$app->get('/cnpj', 'Controller@generateCnpj');
$app->get('/cnpj/{formatted}', 'Controller@generateCnpj');
$app->get('/cc', 'Controller@generateCreditCard');
$app->get('/cc/list', 'Controller@listCreditCardFlags');
$app->get('/cc/json/', 'Controller@generateCreditCardJson');
$app->get('/cc/{flag}', 'Controller@generateCreditCard');
$app->get('/cc/json/{flag}', 'Controller@generateCreditCardJson');
