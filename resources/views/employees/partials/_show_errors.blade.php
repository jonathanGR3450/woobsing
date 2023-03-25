@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all('<li>:message</li>') as $message)
                {!! $message !!}
            @endforeach
        </ul>
    </div>
@endif