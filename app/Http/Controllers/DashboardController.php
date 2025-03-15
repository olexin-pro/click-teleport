<?php

namespace App\Http\Controllers;


use App\Http\Resources\UrlResource;
use AshAllenDesign\ShortURL\Models\ShortURL;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function main(Request $request)
    {
        $urls = ShortURL::query()
            ->select([
                "id",
                "destination_url",
                "url_key",
                "default_short_url",
                "created_at"
            ])
            ->paginate(48);

        return Inertia::render('Dashboard',[
            'urls' => UrlResource::collection($urls)->toArray($request),
        ]);
    }
}
