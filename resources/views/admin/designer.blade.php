@include('admin.include.header')
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_admin">
            <h3>manage user designer</h3>
        </div>
        <div class="task_frm form_table">
            <div class="tabel_scoller">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <table class="table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone </th>
                            <th>Location</th>
                            <th>Status</th>
                            <!--<th>Action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($designers as $designer)
                        <tr>
                            <td>
    <img src="{{ asset($designer->profile_image) }}"
         onerror="this.onerror=null;this.src='https://cdn-icons-png.flaticon.com/512/149/149071.png';"
         alt="User"
         style="width:50px;height:50px;border-radius:50%;object-fit:cover;">
</td>
                            <td>{{ $designer->name }}</td>
                            <td>{{ $designer->email }}</td>
                            <td>{{ $designer->phone }}</td>
                            <td>{{ $designer->address }}</td>
                            <td> 
                                <form action="{{ route('admin.users.toggle-status', $designer) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="statusBtn btn-sm {{ $designer->status ? 'btn-success' : 'btn-secondary' }}">
                                        {{ $designer->status ? 'Approved' : 'Disapproved' }}
                                    </button>
                                </form>
                            </td>

                            <td>
                                <div class="btn_grp">
                            
                                    <!-- View Button -->
                                    <button
                                        type="button"
                                        class="btn btn-primary viewDesigner"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewDesignerModal"
                            
                                        data-image="{{ asset($designer->profile_image) }}"
                                        data-name="{{ $designer->name }}"
                                        data-email="{{ $designer->email }}"
                                        data-phone="{{ $designer->phone }}"
                                        data-address="{{ $designer->address }}"
                                        data-status="{{ $designer->status ? 'Approved' : 'Disapproved' }}"
                                    >
                                        <i class="fa fa-eye"></i>
                                    </button>
                            
                                    <!-- Edit Button -->
                                    <button
                                        type="button"
                                        class="btn edit_bg btn-primary editDesigner"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editDesignerModal"
                            
                                        data-id="{{ $designer->id }}"
                                        data-name="{{ $designer->name }}"
                                        data-email="{{ $designer->email }}"
                                        data-phone="{{ $designer->phone }}"
                                        data-address="{{ $designer->address }}"
                                    >
                                        <i class="fa fa-pencil"></i>
                                    </button>
                            
                                </div>
                            </td>

                            
                            <!--</td>-->
                        </tr>

                        @endforeach

                    </tbody>
                </table>
                
                <div class="d-flex justify-content-center mt-4">
                    {{ $designers->links() }}
                </div>
                
                <div class="modal fade" id="viewDesignerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Designer Details</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="text-center mb-3">
                    <img id="view_image"
                        src=""
                        style="width:120px;height:120px;border-radius:50%;object-fit:cover;">
                </div>

                <table class="table table-bordered">

                    <tr>
                        <th width="30%">Name</th>
                        <td id="view_name"></td>
                    </tr>

                    <tr>
                        <th>Email</th>
                        <td id="view_email"></td>
                    </tr>

                    <tr>
                        <th>Phone</th>
                        <td id="view_phone"></td>
                    </tr>

                    <tr>
                        <th>Location</th>
                        <td id="view_address"></td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td id="view_status"></td>
                    </tr>

                </table>

            </div>

        </div>
    </div>
</div>



<div class="modal fade" id="editDesignerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form id="editDesignerForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Edit Designer</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label>Name</label>

                            <input
                                type="text"
                                class="form-control"
                                name="name"
                                id="edit_name" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Email</label>

                            <input
                                type="email"
                                class="form-control"
                                name="email"
                                id="edit_email" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Phone</label>

                            <input
                                type="text"
                                class="form-control"
                                name="phone"
                                id="edit_phone" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label>Location</label>

                            <input
                                type="text"
                                class="form-control"
                                name="address"
                                id="edit_address" required>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Close
                    </button>

                    <button
                        type="submit"
                        class="btn btn-success">
                        Update Designer
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // View Modal
    document.querySelectorAll('.viewDesigner').forEach(function(button){

        button.addEventListener('click', function(){

            document.getElementById('view_image').src = this.dataset.image;
            document.getElementById('view_name').innerHTML = this.dataset.name;
            document.getElementById('view_email').innerHTML = this.dataset.email;
            document.getElementById('view_phone').innerHTML = this.dataset.phone;
            document.getElementById('view_address').innerHTML = this.dataset.address;
            document.getElementById('view_status').innerHTML = this.dataset.status;

        });

    });

    // Edit Modal
    document.querySelectorAll('.editDesigner').forEach(function(button){

        button.addEventListener('click', function(){

            document.getElementById('edit_name').value = this.dataset.name;
            document.getElementById('edit_email').value = this.dataset.email;
            document.getElementById('edit_phone').value = this.dataset.phone;
            document.getElementById('edit_address').value = this.dataset.address;

            document.getElementById('editDesignerForm').action =
                "/admin/designers/" + this.dataset.id;

        });

    });

});

</script>


<script>
    setTimeout(function () {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 300);
        });
    }, 3000);
</script>

@include('admin.include.footer')