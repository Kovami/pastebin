<?php

namespace App\Events;

use App\Models\Paste;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasteCreatedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public Paste $paste;

    public function __construct(Paste $paste)
    {
        $this->paste = $paste;
    }
}
