@if (session('alert') === 'success')
    <div id="successAlert" class="alert alert-success alert-dismissible" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session('alert') === 'error')
    <div id="errorAlert" class="alert alert-danger alert-dismissible" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<script>
    setTimeout(function() {
        document.getElementById('successAlert').style.display = 'none';
    }, 3000);

    setTimeout(function() {
        document.getElementById('errorAlert').style.display = 'none';
    }, 3000);
</script>