<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Response;
use Inertia\ResponseFactory;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response|ResponseFactory
     */
    public function index(): Response|ResponseFactory
    {
        $company = Company::find(1);

        return inertia('Company/Show', [
            'company' => new CompanyResource($company),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyRequest $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(CompanyRequest $request): JsonResponse|RedirectResponse
    {
        $company = Company::firstOrCreate(
            ['id' => 1],
            $request->validated()
        );

        Log::channel('admin_actions')
            ->info(Auth::id() . ': ' .json_encode($request->validated()));

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'profile-information-updated');
    }
}
