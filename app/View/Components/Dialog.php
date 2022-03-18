<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dialog extends Component
{
    /**
     * The dialog id.
     *
     * @var string
     */
    public $id;

    /**
     * The dialog title.
     *
     * @var string
     */
    public $title;

    /**
     * Create a new component instance.
     *
     * @param  string  $id
     * @return void
     */
    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dialog');
    }
}
