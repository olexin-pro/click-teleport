<?php

namespace App\Http\Controllers;

use AshAllenDesign\ShortURL\Classes\Builder;

abstract class Controller
{
    protected ?Builder $urlBuilder;

    public function __construct()
    {
        $this->urlBuilder = app(Builder::class);
    }
}
