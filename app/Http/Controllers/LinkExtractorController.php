<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LinkExtractorService;

class LinkExtractorController extends Controller
{
    //
    public function extract(Request $request, LinkExtractorService $extractor)
    {
        $url = $request->query('url');

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return response()->json(['error' => 'URL tidak valid'], 400);
        }

        $result = $extractor->extract($url);

        return response()->json($result);
    }
}
