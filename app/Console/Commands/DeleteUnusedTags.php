<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;

class DeleteUnusedTags extends Command
{
    /**
     * @var string
     */
    protected $signature = 'delete:unused-tags';

    /**
     * @var string
     */
    protected $description = 'Delete all unused Tag Models';

    public function handle(): void
    {
        Tag::query()
            ->whereDoesntHave('tasks')
            ->get()
            ->each(function (Tag $tag): void {
                $tag->delete();
            });
    }
}
