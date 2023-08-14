<?php

namespace Source\Controllers\NewsApi;

class Users extends NewsApi
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        $response = $this->headers;
        $this->back($response);
    } 

}