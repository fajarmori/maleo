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
        Site::create($request->validated());
        return to_route('sites.index');
    }

    public function show(Site $site)
    {
        $site = Site::query()->where('slug',$site->slug)->first();
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
        return to_route('sites.index');
    }

    public function destroy(Site $site)
    {
        Site::query()->where('id', $site->id)->delete();
        return to_route('sites.index');
    }
}
