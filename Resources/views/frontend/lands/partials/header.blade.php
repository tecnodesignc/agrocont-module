@php
    $lands = ladsByUser($currentUser->id);
@endphp

    <li class="dropdown hidden-xs">
        {!! Form::open(['route' => ['agrocont.lands.userLand'], 'method' => 'post']) !!}
        <select class="selectpicker hidden-xs" data-style="btn-custom" onchange="this.form.submit()">
            @foreach($lands as $land)
                <option value="{{$land->id}}" {{session('land')==$land->id?'selected':''}}>{{$land->title}}</option>
            @endforeach
        </select>
        {!! Form::close() !!}

@push('js-stack')
    <script>
        jQuery(document).ready(function () {
            @if(!($landview??false))
            @if(session()->exists('land'))
            // $('#selectLands').modal('show');
            $('#selectLands').modal({backdrop: 'static', keyboard: false})
            @endif
            @endif

        });
    </script>
@endpush