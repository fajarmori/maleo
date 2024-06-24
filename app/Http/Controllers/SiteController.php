<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Requests\SiteRequest;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $sites = Site::query()->latest()->get();
        return view('site.index',['sites' => $sites]);
    }

    public function create()
    {
        return view('site.form',[
            'site' => new Site(),
            'page_meta' => collect([
                'title' => 'Create a Site',
                'method' => 'post',
                'url' => route('sites.store'),
            ]),
        ]);
    }

    public function store(SiteRequest $request)
    {
        $site = Site::create($request->validated());
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created site_id - '.$site->id]);
        return to_route('sites.index');
    }

    public function show(Site $site)
    {
        $site = Site::query()->where('id',$site->id)->first();
        return view('site.show',['site' => $site]);
    }

    public function edit(Site $site)
    {
        return view('site.form',[
            'site' => $site,
            'page_meta' => [
                'title' => 'Edit Site',
                'method' => 'put',
                'url' => route('sites.update', $site),
            ],
        ]);
    }

    public function update(SiteRequest $request, Site $site)
    {
        $site->update([
            'name' => $request->name,
            'owner' => $request->owner,
            'district' => $request->district,
            'regency' => $request->regency,
            'province' => $request->province,
            'description' => $request->description,
        ]);
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated site_id - '.$site->id]);
        return to_route('sites.show',['site' => $site]);
    }

    public function destroy(Site $site)
    {
        Site::query()->where('id', $site->id)->delete();
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted site_id - '.$site->id]);
        return to_route('sites.index');
    }
}
