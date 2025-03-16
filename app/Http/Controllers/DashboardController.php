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
            ->where('user_id', $request->user()->id)
            ->select([
                "id",
                "destination_url",
                "url_key",
                "default_short_url",
                "created_at"
            ]);

        return Inertia::render('Dashboard',[
            'urls' => UrlResource::collection($urls->paginate(48))
                ->toArray($request),
        ]);
    }
}
