<?php

namespace App\View\Components\Form;
use Illuminate\View\Component;

class InputText extends Component
{
    public $label;
    public $name;
    public $class;
    public $column;
    public $id;

    public function __construct($label, $name, $class = "form-control",$column=3, $id=null)
    {
        $this->label = $label;
        $this->name = $name;
        $this->class = $class;
        $this->column = $column;
        $this->id = $id;
    }

    public function render()
    {
        return view('components.form.input-text');
    }
}
