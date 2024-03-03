<?php

namespace App\Listeners;

use App\Events\PasteCreatedEvent;
use App\Jobs\DeletePasteJob;

class StartDeleteJobOnPasteCreated
{
    /**
     * Handle the event.
     */
    public function handle(PasteCreatedEvent $event): void
    {
        $paste = $event->paste;
        DeletePasteJob::dispatch($paste)
            ->delay($paste->expires_at);
    }
}
