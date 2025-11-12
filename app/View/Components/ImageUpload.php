<?php
namespace App\View\Components;
use Illuminate\View\Component;

class ImageUpload extends Component
{
    public string $mode;
    public string $name;
    public ?string $value;
    public ?array $values;

    public function __construct(
        string $mode = 'single',
        string $name = 'image',
        string $value = null,
        array $values = null
    ) {
        $this->mode   = $mode;
        $this->name   = $name;
        $this->value  = $value;
        $this->values = $values;
    }

    public function render()
    {
        return view('components.image-upload');
    }
}
