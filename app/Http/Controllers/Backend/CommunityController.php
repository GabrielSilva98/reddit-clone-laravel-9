<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommunityStoreRequest;
use App\Models\Community;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CommunityController extends Controller
{
    
    public function index()
    {
        $communities = Community::all();
        return Inertia::render('Communities/Index', compact('communities'));
    }

    
    public function create()
    {
        return Inertia::render('Communities/Create');
    }

    
    public function store(CommunityStoreRequest $request)
    {
        Community::create($request->validated() + ['user_id' => auth()->id()]);

        return to_route('communities.index')->with('message', 'Community created successfully.');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit(Community $community)
    {
        return Inertia::render('Communities/Edit', compact('community'));
    }

   
    public function update(CommunityStoreRequest $request, Community $community)
    {
        $community->update($request->validated());

        return to_route('communities.index');
    }

    
    public function destroy(Community $community)
    {
        $community->delete();
        return back('communities.index')->with('message', 'Community deleted successfully.');
    }
}
