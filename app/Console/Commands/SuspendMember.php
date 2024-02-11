<?php

namespace App\Console\Commands;

use App\Jobs\SuspendMemberJob;
use App\Models\MemberModel;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class SuspendMember extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'suspendmemberCommend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::table('jobs')->truncate();
        MemberModel::where('status', 1)->whereDate('connection_to', '<=', Carbon::now()->addMonths(3)->setTime(0, 0, 0)->toDateTimeString())->chunk(50, function ($users) {
            SuspendMemberJob::dispatch($users);
        });
    }
}
