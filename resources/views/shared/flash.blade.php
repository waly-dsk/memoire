<style>
    .flash-message {
        opacity: 2;
        transition: opacity 2s;
    }

    .flash-message.fade-out {
        opacity: 0;
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger text-center flash-message">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success text-center flash-message" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success text-center flash-message" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif

@if (Session::get('error', false))
    <div class="alert alert-danger text-center flash-message" role="alert">
        <i class="fa fa-check"></i>
        {{ session('error') }}
    </div>
@endif
<script>
    setTimeout(function() {
        var flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function(message) {
            message.classList.add('fade-out');
        });
    }, 5000);
    setTimeout(function() {
        document.getElementById('flash').style.display = 'none';
    }, 6000);
</script>
