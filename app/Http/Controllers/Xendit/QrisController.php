<?php

namespace App\Http\Controllers\Xendit;

use App\Http\Controllers\Controller;
use App\Models\Selling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QrisController extends Controller
{
    public function index(Request $request)
    {
        $url = config('xendit-qris.url') . '/qr_codes/' . $request->qr_id . '/payments';

        $response = Http::withBasicAuth(
            config('xendit-qris.api_key'),
            ''
        )->get($url);

        if ($response->ok()) {
            return response()->json([
                'data' => count($response->json()) > 0,
            ]);
        } else {
            throw new \ErrorException(json_encode($response->json(), true));
        }
    }

    public function store(Request $request)
    {
        $url = config('xendit-qris.url') . '/qr_codes';

        $pos = Selling::orderBy('id', 'desc')->first();
        
        // dd($request->all());
        
        if (is_null($pos)) {
            $pos = 0;
        } else {
            $pos = $pos->id;
        }
        
        $response = Http::withBasicAuth(
            config('xendit-qris.api_key'), ''
            )->withHeaders([
                'api-version' => config('xendit-qris.api_version'),
                ])->post($url, [
                    'reference_id' => 'test-' . $pos + 2,
                    'type' => 'DYNAMIC',
                    'currency' => 'IDR',
                    'amount' => intval($request->amount),
                ]);
                
        if ($response->status() == 201) {
            return response()->json([
                'data' => $response->json(),
            ]);
        } else {
            throw new \ErrorException(json_encode($response->json(), true));
        }
    }
}
