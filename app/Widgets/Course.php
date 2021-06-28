<?php

namespace App\Widgets;

use App\Models\Course as ModelsCourse;
use App\Models\Setting;
use Arrilot\Widgets\AbstractWidget;

class Course extends AbstractWidget
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
        $course = ModelsCourse::where('status','1')->get()->take(3);
        $description = Setting::where('name', 'CourseDescription')->first();
        return view('widgets.course', [
            'config' => $this->config,
        ])->withCourses($course)->withData($description);
    }
}
