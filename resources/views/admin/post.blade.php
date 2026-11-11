@include('admin.include.header')

<div class="row">
<div class="content-wrapper">
    <div class="dashboard_inner">
        <div class="heading_admin">
            <h3>All Posts</h3>
        </div>
        @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

        <div class="task_frm form_table">
            <div class="tabel_scoller">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Comments</th> 
                             <th width="120">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $index => $post)
                        @php 
                            $postCommentsCount = App\Models\PostComment::where('post_id', $post->id)->count();
                        @endphp
                        <tr>
    <td>{{ $index + 1 }}</td>

    <td title="{{ $post->title }}">
        {{ \Illuminate\Support\Str::limit($post->title, 50) }}
    </td>

    <td title="{{ $post->description }}">
        {{ \Illuminate\Support\Str::limit($post->description, 100) }}
    </td>

    <td>{{ $postCommentsCount }}</td>

    <td>
    <form action="{{ route('admin.posts.destroy', $post->id) }}"
          method="POST"
          class="delete-form"
          style="display:inline-block;">

        @csrf
        @method('DELETE')

        <button type="button" class="btn btn-danger btn-sm deleteBtn">
            <i class="fa fa-trash"></i>
        </button>

    </form>
</td>
</tr>
                        @endforeach
                    </tbody>
                </table>

                @if($posts->isEmpty())
                    <div class="text-center py-4">
                        <em>No post entries found.</em>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.deleteBtn').forEach(function(button){

        button.addEventListener('click', function(){

            let form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to recover this post!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });

        });

    });

});
</script>
@include('admin.include.footer')
