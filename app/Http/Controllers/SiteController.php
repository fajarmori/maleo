<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\SiteRequest;
use Illuminate\Support\Facades\Gate;
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
        $site = new Site();
        Gate::authorize('crudSite', $site);

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
        $site = new Site();
        Gate::authorize('crudSite', $site);

        $user = User::query()->where('email',$request->email)->first();
        $site = Site::create([
            'name' => $request->validated('name'),
            'code' => $request->validated('code'),
            'owner' => $request->validated('owner'),
            'district' => $request->validated('district'),
            'regency' => $request->validated('regency'),
            'province' => $request->validated('province'),
            'description' => $request->validated('description'),
            'user_id' => $user->id??NULL,
        ]);

        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'created site_id - '.$site->id]);
        return to_route('sites.index');
    }

    public function show(Site $site)
    {
        Gate::authorize('listSite', $site);

        $site = Site::query()->where('id',$site->id)->first();
        return view('site.show',['site' => $site]);
    }

    public function edit(Site $site)
    {
        Gate::authorize('crudSite', $site);

        return view('site.form',[
            'site' => $site,
            'page_meta' => collect([
                'title' => 'Edit Site',
                'method' => 'put',
                'url' => route('sites.update', $site),
            ]),
        ]);
    }

    public function update(SiteRequest $request, Site $site)
    {
        Gate::authorize('crudSite', $site);

        $user = User::query()->where('email',$request->email)->first();
        $site->update([
            'name' => $request->validated('name'),
            'code' => $request->validated('code'),
            'owner' => $request->validated('owner'),
            'district' => $request->validated('district'),
            'regency' => $request->validated('regency'),
            'province' => $request->validated('province'),
            'description' => $request->validated('description'),
            'user_id' => $user->id??NULL,
        ]);

        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'updated site_id - '.$site->id]);
        return to_route('sites.show',['site' => $site]);
    }

    public function destroy(Site $site)
    {
        Gate::authorize('crudSite', $site);

        $site->update(['code' => 'DEL-'.$site->code,'user_id' => NULL]);
        Site::query()->where('id', $site->id)->delete();
        
        Log::create(['user_id' => auth()->user()->id, 'email' => auth()->user()->email, 'log' => 'deleted site_id - '.$site->id]);
        return to_route('sites.index');
    }
}
