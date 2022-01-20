<?php

namespace App\Http\Livewire;

use App\Models\JobApplicationSchedule;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Class ViewSlotScreen
 */
class ViewSlotScreen extends Component
{
    use WithPagination;

    /**
     * @var string
     */
    public $stage = '', $jobApplicationId = '';

    /**
     * @var string[]
     */
    protected $listeners = ['changeFilter', 'refresh' => '$refresh', 'stageFilter'];

    /**
     * @param $param
     * @param $value
     */
    public function changeFilter($param, $value)
    {
        $this->resetPage();
        $this->$param = $value;
    }

    /**
     * @param $param
     * @param $value
     */
    public function stageFilter($param, $value)
    {
        $this->resetPage();
        $this->$param = $value;
    }

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        $jobSchedules = $this->jobSchedule();
        /** @var JobApplicationSchedule $jobApplicationSchedules */
        $jobApplicationSchedules = JobApplicationSchedule::whereJobApplicationId($this->jobApplicationId);
        $lastRecord = $jobApplicationSchedules->latest()->first();
        $isStatusNotSend = true;
        if (isset($lastRecord)) {
            $isStatusNotSend = JobApplicationSchedule::where('stage_id', $lastRecord->stage_id)->whereBatch($lastRecord->batch)
                ->whereNotIn('status', [JobApplicationSchedule::STATUS_NOT_SEND])
                ->exists();
        }

        return view('livewire.view-slot-screen', compact('jobSchedules', 'isStatusNotSend'));
    }

    /**
     * @return mixed
     */
    public function jobSchedule()
    {
        /** @var JobApplicationSchedule $jobSchedules */
        $query = JobApplicationSchedule::with('jobApplication.candidate')
            ->whereJobApplicationId($this->jobApplicationId);
        $query->when(!empty($this->stage),
            function (Builder $q) {
                $q->where('stage_id', $this->stage);
            });

        return   $query->get()->sortByDesc('batch')->groupBy('batch');
    }
}
