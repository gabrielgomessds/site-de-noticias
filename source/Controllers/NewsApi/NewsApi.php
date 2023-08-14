<?php

namespace Source\Controllers\NewsApi;

use Source\Core\Controller;
use Source\Models\Admin;
use Source\Models\AuthAdmin;
use Source\Models\News;

class NewsApi extends Controller
{
    protected $user;

    protected $headers;
    
    protected $response;


    public function __construct()
    {
        parent::__construct("/");

        header('Content-Type: application/json; charset=UTF-8');
        $this->headers = getallheaders();

        $request = $this->requestLimit("newsApi", 1, 1);
        if (!$request) {
            exit;
        }

        $auth = $this->auth();
        if (!$auth) {
            exit;
        }

        (new Admin())->start($this->user);

    }

   
    protected function call(int $code, string $type = null, string $message = null, string $rule = "errors"): NewsApi
    {
        http_response_code($code);

        if (!empty($type)) {
            $this->response = [
                $rule => [
                    "type" => $type,
                    "message" => (!empty($message) ? $message : null)
                ]
            ];
        }
        return $this;
    }

   
    protected function back(array $response = null): NewsApi
    {
        if (!empty($response)) {
            $this->response = (!empty($this->response) ? array_merge($this->response, $response) : $response);
        }

        echo json_encode($this->response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        return $this;
    }

  
    private function auth(): bool
    {
        $endpoint = ["newsApiAuth", 3, 60];
        $request = $this->requestLimit($endpoint[0], $endpoint[1], $endpoint[2], true);

        if (!$request) {
            return false;
        }

        if (empty($this->headers["email"]) || empty($this->headers["password"])) {
            $this->call(
                400,
                "auth_empty",
                "Favor informe seu e-mail e senha"
            )->back();
            return false;
        }
 
        $auth = new AuthAdmin();
        $user = $auth->attempt($this->headers["email"], $this->headers["password"], 1);

        if (!$user) {
            $this->requestLimit($endpoint[0], $endpoint[1], $endpoint[2]);
            $this->call(
                401,
                "invalid_auth",
                $auth->message()->getText()
            )->back();
            return false;
        }

        $this->user = $user;
        return true;
    }

   
    protected function requestLimit(string $endpoint, int $limit, int $seconds, bool $attempt = false): bool
    {
        $userToken = (!empty($this->headers["email"]) ? base64_encode($this->headers["email"]) : null);

        if (!$userToken) {
            $this->call(
                400,
                "invalid_data",
                "Você precisa informar seu e-mail e senha para continuar"
            )->back();

            return false;
        }

        $cacheDir = __DIR__ . "/../../../" . CONF_UPLOAD_DIR . "/requests";
        if (!file_exists($cacheDir) || !is_dir($cacheDir)) {
            mkdir($cacheDir, 0755);
        }

        $cacheFile = "{$cacheDir}/{$userToken}.json";
        if (!file_exists($cacheFile) || !is_file($cacheFile)) {
            fopen($cacheFile, "w");
        }

        $userCache = json_decode(file_get_contents($cacheFile));
        $cache = (array)$userCache;

        $save = function ($cacheFile, $cache) {
            $saveCache = fopen($cacheFile, "w");
            fwrite($saveCache, json_encode($cache, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            fclose($saveCache);
        };

        if (empty($cache[$endpoint]) || $cache[$endpoint]->time <= time()) {
            if (!$attempt) {
                $cache[$endpoint] = [
                    "limit" => $limit,
                    "requests" => 1,
                    "time" => time() + $seconds
                ];

                $save($cacheFile, $cache);
            }

            return true;
        }

        if ($cache[$endpoint]->requests >= $limit) {
            $this->call(
                400,
                "request_limit",
                "Você exedeu o limite de requisições para essa ação"
            )->back();

            return false;
        }

        if (!$attempt) {
            $cache[$endpoint] = [
                "limit" => $limit,
                "requests" => $cache[$endpoint]->requests + 1,
                "time" => $cache[$endpoint]->time
            ];

            $save($cacheFile, $cache);
        }
        return true;
    }
}