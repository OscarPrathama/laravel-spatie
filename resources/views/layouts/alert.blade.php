@if (session('success'))
    <div
        class="alert alert-success alert-dismissible fade show" role="alert"
        style="position: fixed; bottom: 2%; right: 2%;">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
