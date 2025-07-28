<?php

namespace App\View\Components;

use Closure;
use App\Helpers\Helper;
use App\Helpers\Helpers;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AppConfig extends Component
{
  public $configData;
  /**
   * Create a new component instance.
   */
  public function __construct()
  {
    $this->configData = Helpers::appClasses();
  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|Closure|string
  {
    return view('components.app-config', [
      'configData' => $this->configData
    ]);
  }
}
