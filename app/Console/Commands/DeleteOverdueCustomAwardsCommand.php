<?php

namespace App\Console\Commands;

use App\Models\CustomAward;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOverdueCustomAwardsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-overdue-custom-awards';

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
        CustomAward::query()
            ->whereNotNull('final_date')
            ->where('final_date', '<', Carbon::now())
            ->delete();
    }
}
