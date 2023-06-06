<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync users from external source';

    /**
     * @return void
     * @throws \JsonException
     */
    public function handle(): void
    {
        $this->line('Loading....');

        $response = resolve('sync_users')->sync();

        if ($response['result']) {
            $this->info($response['message'] ?? '');
        } else {
            $this->error('Error: ' . $response['message'] ?? '');
        }
    }
}
