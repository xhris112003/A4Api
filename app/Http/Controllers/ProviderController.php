<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Provider;
use App\Http\Resources\ProviderResource;

class ProviderController extends Controller
{
    public function index()
    {
        $providers = Provider::all();

        return ProviderResource::collection($providers);
    }
    public function show(Provider $provider)
    {
        return new ProviderResource($provider);
    }           

    public function store(Request $request)
    {
        $provider = Provider::create($request->all());

        return new ProviderResource($provider);
    }

    public function update(Request $request, Provider $provider)
    {
        $provider->update($request->all());

        return new ProviderResource($provider);
    }

    public function destroy(Provider $provider)
    {
        $provider->delete();

        return response(null, 204);
    }
}