<?php

declare(strict_types=1);

namespace App\Http\Controllers\Paste;

use App\Enums\LanguageEnum;
use App\Enums\VisibilityEnum;
use App\Events\PasteCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Paste\CreatePasteRequest;
use App\Models\Paste;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CreateController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Paste/Create', [
            'visibilities' => VisibilityEnum::cases(),
            'languages' => LanguageEnum::cases(),
            'expirations' => [
                ['name' => '10 минут', 'value' => 60*10],
                ['name' => '1 час', 'value' => 60*60],
                ['name' => '3 часа', 'value' => 60*60*3],
                ['name' => '1 день', 'value' => 60*60*24],
                ['name' => '1 неделя', 'value' => 60*60*24*7],
                ['name' => '1 месяц', 'value' => 60*60*24*30],
            ]
        ]);
    }

    public function store(CreatePasteRequest $request): Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
    {
        /** @var User $user */
        $user = $request->user();

        $paste = new Paste();
        $paste->fill([
            'user_id' => $user?->id,
            'title' => $request->get('title') ?? 'Без наименования',
            'body' => $request->get('body'),
            'language' => $request->get('language'),
            'visibility' => $request->get('visibility'),
            'uri' => Str::random(8),
            'expires_at' => Carbon::now()->addSeconds($request->get('expires_at'))
        ]);
        $paste->save();

        event(new PasteCreatedEvent($paste));

        return redirect(sprintf('/%s', $paste->uri));
    }
}
