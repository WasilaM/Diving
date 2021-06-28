<?php

namespace App\Widgets;

use App\Models\Setting;
use Arrilot\Widgets\AbstractWidget;

class Contact extends AbstractWidget
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
        return view('widgets.contact', [
            'config' => $this->config,
        ])->withContact($contact);
    }
}
