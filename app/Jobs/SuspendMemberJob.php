<?php

namespace App\Jobs;

use App\Models\MemberAssignDeviceModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SuspendMemberJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $key => $value) {
            $value->status = 0;
            $value->update();
            $this->assign_device_manage($value->id);
        }
    }

    function assign_device_manage($member_id)
    {
        $assign_member_device = MemberAssignDeviceModel::where('member_id', $member_id)->get();
        foreach ($assign_member_device as $data) {
            $data->status = 3;
            $data->update();
        }
    }
}
