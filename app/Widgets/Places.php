<?php

namespace App\Widgets;

use App\Models\Place;
use App\Models\Setting;
use Arrilot\Widgets\AbstractWidget;

class Places extends AbstractWidget
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
        $place = Place::where('status', '1')->get()->take(3);
        $setting = Setting::where('name', 'PlacesDescription')->first();
        return view('widgets.places', [
            'config' => $this->config,
        ])->withPlaces($place)->withSetting($setting);
    }
}
