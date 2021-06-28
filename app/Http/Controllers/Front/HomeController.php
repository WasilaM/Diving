<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Activity;
use App\Models\Booking;
use App\Models\Course;
use App\Models\Place;
use App\Models\Setting;
use App\Models\Trip;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function Home()
    {
        return view('front.home');
    }

    public function about()
    {
        $abouts = About::where('status', '1')->get();
        return view('front.about.index')->withAbouts($abouts);
    }

    public function aboutShow($slug)
    {
        $about = About::whereTranslation('slug', $slug)->firstOrFail();
        return view('front.about.show')->withAbout($about);
    }

    public function activity()
    {
        $activities = Activity::where('status', '1')->get();
        return view('front.activity.index')->withActivities($activities);
    }

    public function activityShow($slug)
    {
        $activity = Activity::whereTranslation('slug', $slug)->firstOrFail();
        return view('front.activity.show')->withActivity($activity);
    }

    public function place()
    {
        $places = Place::where('status', '1')->get();
        return view('front.place.index')->withPlaces($places);
    }

    public function placeShow($slug)
    {
        $place = Place::whereTranslation('slug', $slug)->firstOrFail();
        return view('front.place.show')->withPlace($place);
    }

    public function course()
    {
        $courses = Course::where('status', '1')->get();
        return view('front.course.index')->withCourses($courses);
    }

    public function courseShow($slug)
    {
        $course = Course::whereTranslation('slug', $slug)->firstOrFail();
        $contact = Setting::where('name', 'Contact')->first();
        return view('front.course.show')->withCourse($course)->withContact($contact);
    }

    public function trip()
    {
        $trips = Trip::where('status', '1')->get();
        return view('front.trips.index')->withTrips($trips);
    }

    public function tripShow($slug)
    {
        $trip = Trip::whereTranslation('slug', $slug)->firstOrFail();
        $contact = Setting::where('name', 'Contact')->first();
        return view('front.trips.show')->withTrip($trip)->withContact($contact);
    }

    public function offerCourse()
    {
        $offers = Course::where('status', '1')->whereNotNull('offer')->get();
        return view('front.offer.courses.index')->withOffers($offers);
    }

    public function offerCourseShow($slug)
    {
        $offer = Course::whereTranslation('slug', $slug)->firstOrFail();
        $contact = Setting::where('name', 'Contact')->first();
        return view('front.offer.courses.show')->withOffer($offer)->withContact($contact);
    }

    public function offerTrip()
    {
        $offers = Trip::where('status', '1')->whereNotNull('offer')->get();
        return view('front.offer.trips.index')->withOffers($offers);
    }

    public function offerTripShow($slug)
    {
        $offer = Trip::whereTranslation('slug', $slug)->firstOrFail();
        $contact = Setting::where('name', 'Contact')->first();
        return view('front.offer.trips.show')->withOffer($offer)->withContact($contact);
    }

    public function coursebooking(Request $request, $id)
    {
        /* dd($request->all()); */
        $book = new Booking();
        $book->first = $request->firstname;
        $book->last = $request->lastname;
        $book->email = $request->email;
        $book->number = $request->telephone;
        $book->course_id = $id;
        $book->save();
        return redirect()->back();
    }

    public function tripbooking(Request $request, $id)
    {
        $book = new Booking();
        $book->first = $request->firstname;
        $book->last = $request->lastname;
        $book->email = $request->email;
        $book->number = $request->telephone;
        $book->trip_id = $id;
        $book->save();
    }
}
