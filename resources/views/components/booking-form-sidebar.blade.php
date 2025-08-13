<form id="booking-form" class="form-content" method="POST" action="{{ route('packages.book') }}">
    @csrf
    <input type="hidden" name="tour_package_id" value="{{ $package->id }}">

    <h4 class="title white text-center">MAKE A BOOKING</h4>
    <div class="row gy-4">

        <!-- Full Name -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Full Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
        </div>

        <!-- Email -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Email Address</label>
                <input type="email" name="email" class="form-control" required>
            </div>
        </div>

        <!-- Phone -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Phone Number</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
        </div>

        <!-- Country Dropdown -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Country</label>
                <select name="country" class="nice-select" required>
                    <option value="" disabled selected>Select your country</option>
                    @foreach ($countries as $countryCode => $countryName)
                        <option value="{{ $countryCode }}">{{ $countryName }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Toggle Date Option -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Select Booking Type</label>
                <div>
                    <label class="me-3">
                        <input type="radio" name="booking_type" value="batch" checked> Batch Date
                    </label>
                    <label>
                        <input type="radio" name="booking_type" value="custom"> Custom Date
                    </label>
                </div>
            </div>
        </div>

        <!-- Batch Selection -->
        <div class="col-lg-12" id="batch-date-section">
            <div class="form-group">
                <label class="white d-block mb-2">Select Batch</label>

                @if ($package->batches->count() > 0)
                    <select name="tour_batch_id" class="nice-select">
                        <option value="">-- Select a Batch --</option>
                        @foreach ($package->batches as $batch)
                            <option value="{{ $batch->id }}">
                                {{ $batch->start_date->format('Y-m-d') }}
                            </option>
                        @endforeach
                    </select>
                @else
                    <div class="text-light bg-secondary p-2 rounded">
                        No batch available for this package. You can select the custom date .
                    </div>
                @endif
            </div>
        </div>


        <!-- Custom Date Selection -->
        <div class="col-lg-12" id="custom-date-section" style="display:none;">
            <div class="form-group">
                <label class="white d-block mb-2">Select Custom Date</label>
                <input type="date" name="custom_date" class="form-control">
            </div>
        </div>

        <!-- Number of People -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white">No. Of People</label>
                <div class="input-box">
                    <i class="flaticon-add-user"></i>
                    <select class="niceSelect" name="total_people">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            </div>
        </div>

        <!-- Optional Message -->
        <div class="col-lg-12">
            <div class="form-group">
                <label class="white d-block mb-2">Message (Optional)</label>
                <textarea name="message" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <!-- Submit -->
        <div class="col-lg-12">
            <div class="form-group mb-0">
                <button type="submit" class="nir-btn w-100">Book Now</button>
            </div>
        </div>

    </div>
</form>

@push('scripts')
    @push('scripts')
        <script>
            document.querySelectorAll('input[name="booking_type"]').forEach(el => {
                el.addEventListener('change', function() {
                    if (this.value === 'batch') {
                        document.getElementById('batch-date-section').style.display = 'block';
                        document.getElementById('custom-date-section').style.display = 'none';
                    } else {
                        document.getElementById('batch-date-section').style.display = 'none';
                        document.getElementById('custom-date-section').style.display = 'block';
                    }
                });
            });

            $(document).ready(function() {
                $('#booking-form').on('submit', function(e) {
                    e.preventDefault();

                    let formData = $(this).serialize();
                    let actionUrl = $(this).attr('action');

                    $.ajax({
                        type: 'POST',
                        url: actionUrl,
                        data: formData,
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.message,
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                // Optionally reset the form or reload
                                $('#booking-form')[0].reset();
                                $('.nice-select').val('').trigger('change');
                            });
                        },
                        error: function(xhr) {
                            let errors = xhr.responseJSON?.errors || {};
                            let firstError = Object.values(errors)[0]?.[0] ||
                                'An error occurred. Please try again.';

                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: firstError,
                                confirmButtonColor: '#d33',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                });
            });
        </script>
    @endpush
@endpush
