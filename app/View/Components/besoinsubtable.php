<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class besoinsubtable extends Component
{
    /**
     * Create a new component instance.
     */
    public $besoinsDetails;
    public $siteId;
    public $search;
    public $key;
    public function __construct($besoinsDetails, $siteId, $search, $key)

    {
        $this->besoinsDetails = $besoinsDetails;
        $this->siteId = $siteId;
        $this->search = $search;
        $this->key = $key;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.besoinsubtable');
    }
}
