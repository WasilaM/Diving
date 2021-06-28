<?php

namespace App\Widgets;

use App\Models\Setting;
use Arrilot\Widgets\AbstractWidget;

class HomeBanner extends AbstractWidget
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
        $banner = Setting::where('name', 'HomeBanner')->first();
        return view('widgets.home_banner', [
            'config' => $this->config,
        ])->withBanner($banner);
    }
}
