<?php

namespace Kaban\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Kaban\Core\Models\BaseModel;
use Kaban\General\Interfaces\IHittable;
use Kaban\General\Observers\Search\AgencyObserver;
use Kaban\General\Observers\Search\AirlineObserver;
use Kaban\General\Observers\Search\AirportObserver;
use Kaban\General\Observers\Search\AttractionObserver;
use Kaban\General\Observers\DeleteLogObserver;
use Kaban\General\Observers\GramItemObserver;
use Kaban\General\Observers\Search\DailytripObserver;
use Kaban\General\Observers\Search\HashtagObserver;
use Kaban\General\Observers\Search\HotelObserver;
use Kaban\General\Observers\Search\LocationObserver;
use Kaban\General\Observers\Search\PostObserver;
use Kaban\General\Observers\Search\RestaurantObserver;
use Kaban\General\Observers\Search\TourObserver;
use Kaban\General\Observers\Search\TravelogueObserver;
use Kaban\General\Observers\Search\TripObserver;
use Kaban\General\Observers\Search\UserObserver;
use Kaban\General\Resources\Search\AgencyResource;
use Kaban\General\Resources\Search\AirportResource;
use Kaban\General\Resources\Search\HashtagResource;
use Kaban\Models\Admin;
use Kaban\Models\Advertisement;
use Kaban\Models\Agency;
use Kaban\Models\Airline;
use Kaban\Models\Airport;
use Kaban\Models\Amenity;
use Kaban\Models\Attraction;
use Kaban\Models\Chain;
use Kaban\Models\Contact;
use Kaban\Models\Dailytrip;
use Kaban\Models\Event;
use Kaban\Models\Hashtag;
use Kaban\Models\Hotel;
use Kaban\Models\Location;
use Kaban\Models\Lottery;
use Kaban\Models\Moment;
use Kaban\Models\Poll;
use Kaban\Models\Post;
use Kaban\Models\Restaurant;
use Kaban\Models\Review;
use Kaban\Models\Textad;
use Kaban\Models\Tour;
use Kaban\Models\Toururl;
use Kaban\Models\Travel;
use Kaban\Models\Travelogue;
use Kaban\Models\Trip;
use Kaban\Models\User;
use Kaban\Models\Video;

class ObserversServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Post::observe(PostObserver::class);
    }
}
