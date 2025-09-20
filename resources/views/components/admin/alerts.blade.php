<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show toast" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show toast" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let toasts = document.querySelectorAll('.toast');
        toasts.forEach(function (toast) {
            setTimeout(function () {
                toast.classList.remove('show');
                setTimeout(function () {
                    toast.remove();
                }, 300);
            }, 3000);
        });
    });
</script>
