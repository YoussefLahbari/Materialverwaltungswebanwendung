<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RepairSubTable extends Component
{
    /**
     * Create a new component instance.
     */
    public $repairDetails;
    public $materielId;
    public $search;
    public $key;
    
    public function __construct($repairDetails, $materielId, $search, $key)
    {
        $this->repairDetails = $repairDetails;
        $this->materielId = $materielId;
        $this->search = $search;
        $this->key = $key;
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.repair-sub-table');
    }
}
