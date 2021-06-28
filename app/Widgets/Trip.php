<?php

namespace App\Widgets;

use App\Models\Trip as ModelsTrip;
use Arrilot\Widgets\AbstractWidget;

class Trip extends AbstractWidget
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
        $trip = ModelsTrip::where('status', '1')->get()->take(4);
        $offer = ModelsTrip::where('status', '1')->whereNotNull('offer')->inRandomOrder()->get()->take(2);
        return view('widgets.trip', [
            'config' => $this->config,
        ])->withTrips($trip)->withOffers($offer);
    }
}
