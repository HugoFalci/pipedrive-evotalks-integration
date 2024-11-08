<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EvoTalksController extends Controller
{
    private $baseUrl;
    private $apikey;
    private $queueId;

    public function __construct()
    {
        $this->apikey = env('EVOTALKS_API_KEY');
        $this->baseUrl = env('EVOTALKS_BASE_URL');
        $this->queueId = env('EVOTALKS_API_QUEUEID');
    }

    private function apiHeaders()
    {
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }

    private function requestBody(Request $request)
    {
        return array_merge([
            'queueId' => (int) $this->queueId,
            'apiKey' => $this->apikey,
        ], $request->all());
    }

    public function createOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/createOpportunity', $data);
    }

    public function updateOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/updateOpportunity', $data);
    }

    public function removeOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/removeOpportunity', $data);
    }

    public function loseOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/loseOpportunity', $data);
    }

    public function winOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/winOpportunity', $data);
    }

    public function transferOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/transferOpportunity', $data);
    }

    public function changeOpportunityStage(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/changeOpportunityStage', $data);
    }

    public function insertOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/insertOpportunity', $data);
    }

    public function getOpportunity(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/getOpportunity', $data);
    }

    public function getPipeOpportunities(Request $request)
    {
        $data = $this->requestBody($request);
        return $this->sendPostRequest('/int/getPipeOpportunities', $data);
    }

    private function sendPostRequest($endpoint, $data)
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeaders($this->apiHeaders())
            ->post($this->baseUrl . $endpoint, $data);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json([
                'error' => 'Request failed',
                'status' => $response->body(),
                $response->status()
            ], $response->status());
        }
    }
}
