<?php

namespace App\Http\Controllers;


use App\Http\Requests\UrlStoreRequest;
use App\Http\Resources\UrlResource;
use AshAllenDesign\ShortURL\Exceptions\ShortURLException;
use AshAllenDesign\ShortURL\Models\ShortURL;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Inertia\Inertia;

class UrlController extends Controller
{
    /**
     * @throws ShortURLException
     * @throws BindingResolutionException
     */
    public function store(UrlStoreRequest $request)
    {
        $builder = $this->urlBuilder->destinationUrl($request->validated('url'));

        if ($request->filled('key')) {
            $builder->urlKey($request->validated('key'));
        }

        if ($request->filled('single_use') && (bool)$request->validated('single_use', false)) {
            $builder->singleUse();
        }

        if ($request->filled('redirect_code')) {
            $builder->redirectStatusCode((int)$request->validated('redirect_code', 301));
        }

        if ($request->filled('activated_at')) {
            $builder->activateAt(Date::parse($request->validated('activated_at')));
        }

        if ($request->filled('forward_query') && (bool)$request->validated('forward_query', false)) {
            $builder->forwardQueryParams();
        }

        if ($request->filled('deactivateAt')) {
            $builder->activateAt(Date::parse($request->validated('deactivateAt')));
        }

        $resp = $builder->beforeCreate(function (ShortURL $model): void {
            $model->user_id = auth('sanctum')->id();
        })->make();

        return back();
    }

    public function show(ShortURL $shortURL)
    {
        return Inertia::render('Link', [
            'url' => [
                'id' => $shortURL->id,
                "destination_url" => $shortURL->destination_url,
                "url_key" => $shortURL->url_key,
                "default_short_url" => $shortURL->default_short_url,
                "created_at" => $shortURL->created_at,
                'visit_count' => $shortURL->visits()->count(),
                'visits' => $shortURL->visits()->paginate(),
            ]
        ]);
    }


    public function qr(ShortURL $shortURL)
    {
        $svg = (new Writer(
            new ImageRenderer(
                new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72))),
                new SvgImageBackEnd
            )
        ))->writeString($shortURL->default_short_url);

        return response(
            trim(substr($svg, strpos($svg, "\n") + 1)),
            200,
            [
                'Content-Type' => 'image/svg+xml',
            ]
        );
    }
}
