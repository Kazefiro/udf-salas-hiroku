<div class="alert alert-danger alert-dismissible"
        {!! $errors->any() ? '' : "style='display: none'" !!}
>
    <ul>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        @endif
    </ul>
</div>

@if(Session::has('flash_message'))
    <div class="alert alert-success alert-dismissible">
        {{Session::get('flash_message')}}
    </div>
@endif

@if(Session::has('flash_message_del'))
    <div class="alert alert-info alert-dismissible">
        {{Session::get('flash_message_del')}}
    </div>
@endif

@if(Session::has('flash_message_edit'))
    <div class="alert alert-warning alert-dismissible">
        {{Session::get('flash_message_edit')}}
    </div>
@endif
