<?php

namespace App\Widgets;

use App\Models\Setting;
use Arrilot\Widgets\AbstractWidget;

class Menu extends AbstractWidget
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
        $contact = Setting::where('name', 'Contact')->first();
        $social = Setting::where('name', 'SocialMedia')->first();
        return view('widgets.menu', [
            'config' => $this->config,
        ])->withContact($contact)->withData($social->data);
    }
}
