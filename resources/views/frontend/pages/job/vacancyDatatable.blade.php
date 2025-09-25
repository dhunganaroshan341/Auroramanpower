<!-- Table View -->
<div id="tableView" class="pt_30">
    <div class="text-box mb-3">
        <h2>Job <span>Listings</span></h2>
    </div>
    <div class="mb-5">
        <div class="table-responsive"> <!-- ✅ makes it scrollable on small screens -->
            <table id="jobsTable" class="table table-bordered table-striped table-sm text-center align-middle"
                style="border-color: var(--secondary-color); width: 100%;">
                <thead class="table-light">
                    <tr>
                        <th>Country</th>
                        <th>Company</th>
                        <th>Category</th>
                        <th>Job Title</th>
                        <th>No. of People Requested</th>
                        <th>Action</th>
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
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
