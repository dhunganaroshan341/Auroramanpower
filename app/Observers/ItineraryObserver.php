<?php
namespace App\Observers;
use App\Models\Itinerary;
use App\Services\PackageService;

class ItineraryObserver
{
    public function created(Itinerary $itinerary)
    {
        $this->updatePackageDuration($itinerary);
    }

    public function updated(Itinerary $itinerary)
    {
        $this->updatePackageDuration($itinerary);
    }

    public function deleted(Itinerary $itinerary)
    {
        $this->updatePackageDuration($itinerary);
    }

    protected function updatePackageDuration(Itinerary $itinerary)
    {
       if ($itinerary->tourPackage) {
          $service = new PackageService($itinerary->tourPackage);
            $service->updateTotalDuration();
        }
    }
}

