<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PipeDriveController extends Controller
{
    private $baseUrl;
    private $apiToken;

    public function __construct()
    {
        $this->apiToken = env('PIPEDRIVE_API_TOKEN');
        $this->baseUrl = env('PIPEDRIVE_BASE_URL');
    }

    /**
     * Retrieve all deals from Pipedrive.
     */
    public function getDeals()
    {
        $url = "{$this->baseUrl}/v1/deals";
        $params = ['api_token' => $this->apiToken];

        $response = Http::get($url, $params);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            Log::error("Failed to retrieve deals from Pipedrive", ['response' => $response->body()]);
            return response()->json(['error' => 'Request failed'], $response->status());
        }
    }

    /**
     * Retrieve a specific deal by ID from Pipedrive.
     * 
     * @param int $id Deal ID
     */
    public function getDeal($id)
    {
        $url = "{$this->baseUrl}/v1/deals/{$id}";
        $params = ['api_token' => $this->apiToken];

        $response = Http::get($url, $params);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            Log::error("Failed to retrieve deal with ID {$id} from Pipedrive", ['response' => $response->body()]);
            return response()->json(['error' => 'Request failed'], $response->status());
        }
    }
    
    /**
     * Update an existing deal in Pipedrive.
     * 
     * @param Request $request
     * @param int $id Deal ID
     */
    public function updateDeal(Request $request, $id)
    {
        $url = "{$this->baseUrl}/v1/deals/{$id}";
        $data = array_merge($request->all(), ['api_token' => $this->apiToken]);

        $response = Http::put($url, $data);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            Log::error("Failed to update deal with ID {$id} in Pipedrive", ['data' => $data, 'response' => $response->body()]);
            return response()->json(['error' => 'Request failed'], $response->status());
        }
    }
}
