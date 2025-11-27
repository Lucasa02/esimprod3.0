<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BadgeStatus extends Component
{
    public $type;
    public $status;
    public $label;

    public function __construct($type = null, $status = null, $label = null)
    {
        $this->type = $type;
        $this->status = $status;
        $this->label = $label;
    }

    public function render()
    {
        return view('components.badge-status');
    }
}
