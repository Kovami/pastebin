<?php

namespace App\Jobs;

use App\Models\Paste;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeletePasteJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private Paste $paste;

    public function __construct(Paste $paste)
    {
        $this->paste = $paste;
    }

    public function handle(): void
    {
        $this->paste->delete();
    }
}
