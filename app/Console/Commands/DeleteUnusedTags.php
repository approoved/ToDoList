<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;

class DeleteUnusedTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unused-tags';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all unused Tag Models';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tags = Tag::query()
            ->whereDoesntHave('tasks')
            ->get();

        /** @var Tag $tag */
        foreach ($tags as $tag) {
            $tag->delete();
        }
    }
}
