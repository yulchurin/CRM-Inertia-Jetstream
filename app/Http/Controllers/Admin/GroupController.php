<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Http\Resources\GroupCollection;
use App\Http\Resources\GroupFormResource;
use App\Models\Group;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Response;
use Inertia\ResponseFactory;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware('priceFix')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        $groups = Group::paginate(10);

        $groups = (new GroupCollection($groups));

        return inertia('Group/Index', [
            'groups' => $groups,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response|ResponseFactory
     */
    public function create(): Response|ResponseFactory
    {
        return inertia('Group/Show');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return RedirectResponse
     */
    public function store(GroupRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->id) {
            Group::where('id', $request->id)->update($validated);
        } else {
            Group::create($validated);
        }

        return redirect()->back()->with('status', 'group-stored');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response|ResponseFactory
     */
    public function show(int $id): Response|ResponseFactory
    {
        $group = Group::find($id);

        $groupFormResource = $group ? new GroupFormResource($group) : null;

        return inertia('Group/Show', [
            'group' => $groupFormResource,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $group = Group::find($id);

        $this->authorize('delete', $group);

        $group->delete();

        return back()->with('message', 'Group was deleted');
    }
}
