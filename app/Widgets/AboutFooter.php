<?php

namespace App\Widgets;

use App\Models\About;
use Arrilot\Widgets\AbstractWidget;

class AboutFooter extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $about = About::first();
        return view('widgets.about_footer', [
            'config' => $this->config,
        ])->withAbout($about);
    }
}
