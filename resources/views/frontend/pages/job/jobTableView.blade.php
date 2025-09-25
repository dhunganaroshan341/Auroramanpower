<!-- Table View -->
<div id="tableView" class="pt_30">
    <div class="text-box mb-3">
        <h2>Job <span>Listings</span></h2>
    </div>
    <div class="mb-5">
        <table id="jobsTable" class="table table-bordered text-center align-middle"
            style="border-color: var(--secondary-color); width: 100%;">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Company</th>
                    <th>Category</th>
                    <th>Job Title</th>
                    <th>No. of People Requested</th>
                    <th>Action</th> <!-- New column -->
                </tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->vacancy->country ?? 'N/A' }}</td>
                        <td>{{ $job->vacancy->company->name ?? 'Custom Company' }}</td>
                        <td>
                            @foreach ($job->categories as $cat)
                                <span class="badge bg-info">{{ $cat->name }}</span>
                            @endforeach
                        </td>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->openings }}</td>
                        <td>
                            <a href="{{ route('jobDetails', $job->id) }}" class="btn btn-sm btn-primary">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
