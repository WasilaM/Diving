<?php

namespace App\Widgets;

use App\Models\Setting;
use Arrilot\Widgets\AbstractWidget;

class SocialMedia extends AbstractWidget
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
        $social = Setting::where('name', 'SocialMedia')->first();
        return view('widgets.social_media', [
            'config' => $this->config,
        ])->withData($social->data);
    }
}
