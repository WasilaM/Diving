<?php

namespace App\Widgets;

use App\Models\Setting;
use Arrilot\Widgets\AbstractWidget;

class FooterBanner extends AbstractWidget
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
        $footer = Setting::where('name', 'FooterBanner')->first();
        return view('widgets.footer_banner', [
            'config' => $this->config,
        ])->withFooter($footer);
    }
}
