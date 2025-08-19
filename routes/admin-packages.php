// Tour Packages Routes
Route::prefix('tour-packages')->name('tour-packages.')->group(function () {
    Route::get('/', [AdminTourPackageController::class, 'index'])->name('index');
    Route::get('/show/{id}', [AdminTourPackageController::class, 'show'])->name('show');
    Route::post('/store', [AdminTourPackageController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [AdminTourPackageController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [AdminTourPackageController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [AdminTourPackageController::class, 'destroy'])->name('destroy');
    Route::put('/status/{id}', [AdminTourPackageController::class, 'statusToggle'])->name('status');
    Route::put('/status/{id}', [AdminTourPackageController::class, 'statusToggle'])->name('status');
    Route::put('/top-deal/{id}', [AdminTourPackageController::class, 'topDeal'])->name('topDeal');
    Route::put('/favourite-destination/{id}', [AdminTourPackageController::class, 'favDestination'])->name('favDestination');
     Route::get('/latest-order', [AdminTourPackageController::class, 'latestOrder'])->name('latest-order');
});
    Route::get('tour-batches/{tour_package_id}', [\App\Http\Controllers\Admin\TourBatchController::class, 'index']);
    Route::post('tour-batches', [\App\Http\Controllers\Admin\TourBatchController::class, 'store']);
    Route::get('tour-batch/{id}', [\App\Http\Controllers\Admin\TourBatchController::class, 'show']);
    Route::put('tour-batch/{id}', [\App\Http\Controllers\Admin\TourBatchController::class, 'update']);
    Route::delete('tour-batch/{id}', [\App\Http\Controllers\Admin\TourBatchController::class, 'destroy']);

// Itineraries
Route::prefix('itineraries')->name('itineraries.')->group(function () {
    Route::get('/{id}', [ItineraryController::class, 'index'])->name('index');
    Route::get('/show/{id}', [ItineraryController::class, 'show'])->name('show');
    Route::post('/store', [ItineraryController::class, 'store'])->name('store');
    Route::post('/update/{id}', [ItineraryController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [ItineraryController::class, 'destroy'])->name('destroy');
    Route::get('/latest-order/{id}', [ItineraryController::class, 'getLatestOrder'])->name('latestOrder');
});
    Route::get('price-includes/{tourPackageId}', [PriceIncludesController::class, 'index']);
    Route::post('price-includes', [PriceIncludesController::class, 'store']);
    Route::get('price-includes/show/{id}', [PriceIncludesController::class, 'show']);
    Route::put('price-includes/{id}', [PriceIncludesController::class, 'update']);
    Route::delete('price-includes/{id}', [PriceIncludesController::class, 'destroy']);

// Tour Package Images
Route::prefix('tour-package-images')->name('tour-package-images.')->group(function () {
   Route::get('/{tour_package_id}', [AdminTourPackageController::class, 'showImages'])->name('index');
    Route::post('/store', [AdminTourPackageController::class, 'uploadImages'])->name('store');
    Route::delete('/delete/{id}', [AdminTourPackageController::class, 'deleteImages'])->name('destroy');
});

// Tour Package Videos
Route::prefix('tour-package-videos')->name('tour-package-videos.')->group(function () {
    // Route::get('/{tour_package_id}', [AdminTourPackageController::class, 'showImages'])->name('index');
    Route::post('/store', [AdminTourPackageController::class, 'uploadYoutube'])->name('store');
    Route::delete('/delete/{id}', [AdminTourPackageController::class, 'destroy'])->name('destroy');
});
Route::prefix('bookings')->name('bookings.')->group(function () {
    // Route::get('/{tour_package_id}', [AdminTourPackageController::class, 'showImages'])->name('index');
    Route::post('/store', [BookingController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [BookingController::class, 'destroy'])->name('destroy');
    // Bookings
    Route::post('/status/{id}',[BookingController::class,'manageStatus'])->name('status');

    Route::get('/', [BookingController::class, 'index'])->name('index');

});
