<?php

declare(strict_types=1);

namespace App\Http\Controllers\Paste;

use App\Enums\VisibilityEnum;
use App\Http\Controllers\Controller;
use App\Models\Paste;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MyPastesController extends Controller
{
    public function create(Request $request): Response
    {
        /** @var User $user */
        $user = $request->user();
        $perPage = $request->get('per_page', 10);

        $pastes = $user
            ->pastes()
            ->paginate($perPage);

        return Inertia::render('Paste/My', [
            'pastes' => $pastes,
        ]);
    }
}
