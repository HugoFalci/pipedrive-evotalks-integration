<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PipeDriveController extends Controller
{
    private $baseUrl;
    private $apiToken;

    public function __construct()
    {
        $this->apiToken = env('PIPEDRIVE_API_TOKEN');
        $this->baseUrl = env('PIPEDRIVE_BASE_URL');
    }
}