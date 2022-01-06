<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaperRequest;
use App\Http\Requests\ParentPaperRequest;
use App\Traits\GetStudent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaperController extends Controller
{
    use GetStudent;

    public function store(PaperRequest $request)
    {
        $student = $this->getStudent();

        if ($student?->paper()->exists()) {
            $student->paper()->update($request->validated());
        } else {
            $student->person->paper()->create($request->validated());
        }

        Log::channel('user_actions')->info(Auth::id() . ': ' .json_encode($request->validated()));

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'profile-information-updated');
    }

    public function storeParent(ParentPaperRequest $request)
    {
        $student = $this->getStudent();

        $person = $student->legalRepresentative->person;

        if (! $person->paper()->exists()) {
            $person->paper()->create($request->validated());
        } else {
            $person->paper()->update($request->validated());
        }

        Log::channel('user_actions')->info(Auth::id() . ': ' .json_encode($request->validated()));

        return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'profile-information-updated');
    }
}
