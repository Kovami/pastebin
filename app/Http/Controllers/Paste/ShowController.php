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

class ShowController extends Controller
{
    public function create(Request $request): Response
    {
        /** @var User $user */
        $user = $request->user();

        $paste = Paste::query()
            ->where('uri', $request->route('uri'))
            ->where(function (Builder $builder) use ($user) {
                $builder
                    ->whereIn('visibility', [VisibilityEnum::Public->value, VisibilityEnum::Unlisted->value])
                    ->when(!!$user, function (Builder $builder) use ($user) {
                        $builder
                            ->orWhere(function (Builder $builder) use ($user) {
                                $builder
                                    ->where('visibility', VisibilityEnum::Private->value)
                                    ->where('user_id', $user->id);
                            });
                    });
            })
            ->first();

        if (!$paste) {
            abort(404);
        }

        return Inertia::render('Paste/Show', [
            'paste' => $paste,
        ]);
    }
}
