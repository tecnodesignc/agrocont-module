@php
    $lands = ladsByUser($currentUser->id);
@endphp

    <li class="dropdown hidden-xs" style="margin-top: 14px">
        {!! Form::open(['route' => ['agrocont.lands.userLand'], 'method' => 'post']) !!}
        <select class="selectpicker hidden-xs" name="land" data-style="btn-custom" onchange="this.form.submit()">
            @foreach($lands as $land)
                <option value="{{$land->id}}" {{session('land')==$land->id?'selected':''}}>{{$land->name}}</option>
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