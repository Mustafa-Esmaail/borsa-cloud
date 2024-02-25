<?php

namespace App\Console\Commands;

use App\Models\Status;
use Illuminate\Console\Command;

class ExpireStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:expire-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $stories = Status::where('created_at', '<=', now()->subDay())->get();

        foreach ($stories as $story) {
            $story->expires_at = now();
            $story->save();
        }

        // $this->info('Expired ' . count($stories) . ' stories.');
    }
}
