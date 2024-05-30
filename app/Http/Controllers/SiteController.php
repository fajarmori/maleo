<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Models\User;
use App\Http\Requests\SiteRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::query()->latest()->get();
        return view('site.index',['sites' => $sites]);
    }

    public function create()
    {
        return view('site.form');
    }

    public function store(SiteRequest $request)
    {
        Site::create($request->validated());
        return to_route('sites.index');
    }

    public function show(Site $site)
    {
        $site = Site::query()->where('slug',$site->slug)->first();
        return view('site.show',['site' => $site]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        //
    }
}
