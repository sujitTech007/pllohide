@include('designer.include.header')
<style>
    .form-select-sm {
    width: 140px;
    font-size: 14px;
    padding: 2px 6px;
}
</style>
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_bx">
            <h3>My Projects</h3>
        </div><button class="btn_create" data-bs-toggle="modal"
            data-bs-target="#exampleModalnewProject">Create New Project</button>
        <div class="task_frm form_table">
            <div class="tabel_scoller">
                <table class="table">
                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>Project Name</th>
                            <th>Category</th>
                            <th>Created Date</th>
                            <th>Status</th>
                            <th>Action</th>
                            <!-- <th>
                                <div class="Share"><svg xmlns="http://www.w3.org/2000/svg"
                                        width="160" height="40" viewBox="0 0 160 40"
                                        fill="none">
                                        <mask id="path-1-inside-1_15840_2130" fill="white">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M5 0C2.23858 0 0 2.23858 0 5V28C0 30.7614 2.23858 33 5 33H30.3397L28.5002 39.4999L39.4589 33H155C157.761 33 160 30.7614 160 28V5C160 2.23858 157.761 0 155 0H5Z">
                                            </path>
                                        </mask>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M5 0C2.23858 0 0 2.23858 0 5V28C0 30.7614 2.23858 33 5 33H30.3397L28.5002 39.4999L39.4589 33H155C157.761 33 160 30.7614 160 28V5C160 2.23858 157.761 0 155 0H5Z"
                                            fill="white"></path>
                                        <path
                                            d="M30.3397 33L31.3019 33.2723L31.662 32H30.3397V33ZM28.5002 39.4999L27.538 39.2275L26.8559 41.6378L29.0103 40.3599L28.5002 39.4999ZM39.4589 33V32H39.1846L38.9487 32.1399L39.4589 33ZM1 5C1 2.79086 2.79086 1 5 1V-1C1.68629 -1 -1 1.68629 -1 5H1ZM1 28V5H-1V28H1ZM5 32C2.79086 32 1 30.2091 1 28H-1C-1 31.3137 1.68629 34 5 34V32ZM30.3397 32H5V34H30.3397V32ZM29.4624 39.7722L31.3019 33.2723L29.3775 32.7277L27.538 39.2275L29.4624 39.7722ZM38.9487 32.1399L27.9901 38.6398L29.0103 40.3599L39.969 33.8601L38.9487 32.1399ZM155 32H39.4589V34H155V32ZM159 28C159 30.2091 157.209 32 155 32V34C158.314 34 161 31.3137 161 28H159ZM159 5V28H161V5H159ZM155 1C157.209 1 159 2.79086 159 5H161C161 1.68629 158.314 -1 155 -1V1ZM5 1H155V-1H5V1Z"
                                            fill="#D9D9D9"
                                            mask="url(#path-1-inside-1_15840_2130)"></path>
                                    </svg>
                                    <p>Share to community</p>
                                </div>
                            </th> -->
                        </tr>
                    </thead>
                    <tbody>
                    
                        @php 
                        $index = 1;
                        @endphp


                        @foreach ($projects as $project)
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->category}}</td>
                            <td>{{ $project->created_at->format('d M Y') }}</td>
                            <td>
                            @if($project->status == 'in_progress')
                                <span class="badge bg-warning text-dark">In Progress</span>
                            @elseif($project->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-secondary">Unknown</span>
                            @endif
                            </td>
                            <td>
                                <div class="d-flex align-items-center justify-content-end gap-2 btn_grp">
                                    <form action="{{ route('designer.projects.updateStatus', $project->id) }}" method="POST">
                                    @csrf
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="in_progress" {{ $project->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </form>
                                
                                <button
                                    type="button"
                                    class="btn btn-primary btn-sm viewProject"
                                    data-bs-toggle="modal"
                                    data-bs-target="#viewProjectModal"
                                
                                    data-name="{{ $project->name }}"
                                    data-category="{{ $project->category }}"
                                    data-date="{{ $project->created_at->format('d M Y') }}"
                                    data-status="{{ $project->status == 'in_progress' ? 'In Progress' : 'Completed' }}"
                                >
                                    <i class="fas fa-eye"></i>
                                </button>
                                  {{-- Delete Button --}}
                                <form id="delete-form-{{ $project->id }}" action="{{ route('designer.projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="button" class="btn Delete text-danger" onclick="confirmDelete({{ $project->id }})">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </form>
                                </div>
                            </td>
                            
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- view modal -->
<div class="modal fade" id="viewProjectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Project Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <table class="table table-bordered">

                    <tr>
                        <th width="30%">Project Name</th>
                        <td id="view_project_name"></td>
                    </tr>

                    <tr>
                        <th>Category</th>
                        <td id="view_project_category"></td>
                    </tr>

                    <tr>
                        <th>Created Date</th>
                        <td id="view_project_date"></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td id="view_project_status"></td>
                    </tr>

                </table>

            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="exampleModalnewProject" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-5">
                <form class="d-flex gap-2 flex-column" method="POST" action="{{ route('designer.projects.store') }}">
                    @csrf
                    <h5>Create a Project</h5>
                    <div class="input-group mb-3">
                        <input type="text" name="project_name" class="form-control" placeholder="Project Name" aria-label="Project Name">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" name="project_category" class="form-control" placeholder="Category" aria-label="Category">
                    </div>
                    <button type="submit" class="btn btnSubmit m-auto text-white w-auto">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This project will be deleted permanently!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

<script>
document.querySelectorAll('.viewProject').forEach(function(button){

    button.addEventListener('click', function(){

        document.getElementById('view_project_name').innerHTML = this.dataset.name;
        document.getElementById('view_project_category').innerHTML = this.dataset.category;
        document.getElementById('view_project_date').innerHTML = this.dataset.date;
        document.getElementById('view_project_status').innerHTML = this.dataset.status;

    });

});
</script>

@include('designer.include.footer')