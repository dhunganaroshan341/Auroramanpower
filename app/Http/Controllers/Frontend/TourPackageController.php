<?php

    namespace App\Http\Controllers\Frontend;

    use App\Helpers\CountryHelper;
    use App\Http\Controllers\Controller;
    use App\Models\Booking;
    use App\Models\PackageBooking;
    use App\Models\Service;
    use App\Models\TourBatch;
    use App\Models\TourPackage;
    use App\Models\TourPackageType;
    use App\Models\OurCountry;

    use Illuminate\Http\Request;


    class TourPackageController extends Controller
    {
        protected $countries;
        public function __construct()
        {
        $this->countries = CountryHelper::getCountries();
        }

    public function index()
    {
        $data = $this->getFilteredPackages(); // no filters
        return view('frontend.packages-grid', $data);
    }





    public function show($slug)
    {
        $countries = $this->countries;

        $package = TourPackage::with('priceIncludes', 'itineraries')
            ->where('slug', $slug)
            ->where('status', 'Active')
            ->firstOrFail();

        $images = \App\Models\TourPackageImage::where('tour_package_id', $package->id)->get();

    if ($images->isEmpty()) {
        $fallbackUrl = asset('template/yatri_world/main-file/images/tibet_vertical.jpg');
        $images = collect();
        for ($i = 0; $i < 5; $i++) {
            $images->push((object)[
                'image_url' => $fallbackUrl,
                'image_path' => 'template/yatri_world/main-file/images/tibet_vertical.jpg',
            ]);
        }
    } else {
        $images->transform(function ($image) {
            if (str_starts_with($image->image_path, 'http://') || str_starts_with($image->image_path, 'https://')) {
                $image->image_url = $image->image_path;
            } else {
                $image->image_url = asset('uploads/' . ltrim($image->image_path, '/'));
            }
            return $image;
        });
    }
    // dd($images);

        $totalDays = $package->itineraries
            ->filter(fn ($item) => is_numeric($item->day_number))
            ->sum(fn ($item) => (int) $item->day_number);

        $otherPackages = TourPackage::where('our_country_id', $package->our_country_id)
            ->where('id', '!=', $package->id)
            ->get();

        return view('frontend.packages-single', compact('countries', 'package', 'totalDays', 'otherPackages', 'images'));
    }




        public function booking(Request $request)
        {
            $request->validate([
                'tour_package_id' => 'required|exists:tour_packages,id',
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'booking_date' => 'required|date',
                'number_of_people' => 'required|integer|min:1',
                'message' => 'nullable|string',
            ]);

            PackageBooking::create($request->all());

            return response()->json(['message' => 'Booking submitted successfully!']);
        }
        public function getBatches($packageId)
    {
        $batches = TourBatch::where('tour_package_id', $packageId)->get(['id', 'start_date', 'end_date']);

        return response()->json($batches);
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'parent_packages' => 'array',
            'parent_packages.*' => 'string|exists:tour_packages,slug',
            'country' => 'nullable|string',
            'package_type' => 'nullable|string',
            'sort_by' => 'nullable|string|in:low,high',
            'search' => 'nullable|string|max:255',
        ]);

        $data = $this->getFilteredPackages($validated);
        return view('frontend.packages-grid', $data);
    }



  private function getFilteredPackages(array $filters = [])
{
    $countries = $this->countries;
    $services = Service::all();
    $tourPackageTypes = TourPackageType::all();
    $ourCountries = OurCountry::all();

    $countryName = $filters['country'] ?? null;
    $search = $filters['search'] ?? null;
    $parentPackages = $filters['parent_packages'] ?? [];
    $sortBy = $filters['sort_by'] ?? null;
    $packageType = $filters['package_type'] ?? null;
    $minPrice = $filters['min_price'] ?? null;
    $maxPrice = $filters['max_price'] ?? null;

    // Country filter
    $country = null;
    if ($countryName) {
        $country = OurCountry::where('slug', 'LIKE', $countryName)->first();
    }

    // Base query
    $query = TourPackage::query()->where('status', 'Active');

    // Apply filters
    if ($country) {
        $query->where('our_country_id', $country->id);
    }

  if (!empty($parentPackages)) {
    $query->whereHas('parent', function ($q) use ($parentPackages) {
        $q->whereIn('slug', $parentPackages);
    });
}


    if ($packageType) {
        $query->where('package_type', $packageType);
    }
   if ($search) {
    $query->where('title', 'LIKE', '%' . $search . '%');
}

    if ($minPrice !== null) {
        $query->where('price', '>=', $minPrice);
    }

    if ($maxPrice !== null) {
        $query->where('price', '<=', $maxPrice);
    }

    // Sorting
    if ($sortBy === 'low') {
        $query->orderBy('price', 'asc');
    } elseif ($sortBy === 'high') {
        $query->orderBy('price', 'desc');
    }

    $tourPackages = $query->paginate(6)->withQueryString(); // ✅


    // Sidebar: Parent packages
    $parentPackagesQuery = TourPackage::whereNull('parent_id')->whereHas('children');
    if ($country) {
        $parentPackagesQuery->where('our_country_id', $country->id);
    }
    $parentPackages = $parentPackagesQuery->get();

    return compact(
        'countries',
        'ourCountries',
        'tourPackages',
        'services',
        'tourPackageTypes',
        'parentPackages',
        'countryName'
    );
}




    }
