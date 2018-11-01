@extends('layouts.account')


@section('title')
    {{trans('agrocont::lands.title.select')}}| @parent
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">

            <div class="wrapper-page">

                <div class="m-t-40 account-pages">
                    <div class="text-center account-logo-box">
                        <h2 class="text-uppercase">
                            <a href="{{url('/')}}" class="text-success">
                                <span><img src="{{Theme::url('/images/logo.png')}}" alt="" height="36"></span>
                            </a>
                        </h2>
                        <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                    </div>
                    <div class="account-content">
                        @include('partials.notifications')
                        @if(count($lands))
                            {!! Form::open(['route' => 'agrocont.lands.userLand',"class"=>"form-horizontal"]) !!}
                            <div class="form-group {{ $errors->has('land') ? ' has-error' : '' }}">
                                <div class="col-xs-12">
                                    <select name="land" class="selectpicker hidden-xs" data-style="btn-custom">
                                        @foreach($lands as $land)
                                            <option value="{{$land->id}}" {{old('land')==$land->id?'selected':''}}>{{$land->name}}</option>
                                        @endforeach
                                    </select>
                                    {!! $errors->first('land', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group account-btn text-center m-t-10">
                                <div class="col-xs-12">
                                    <button class="btn w-md btn-bordered btn-danger waves-effect waves-light"
                                            type="submit">  {{trans('agrocont::lands.form.Button select')}}
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        @else
                            <div class="row m-t-50">
                                <div class="col-sm-12 text-center">
                                    <p class="text-muted">{{ trans('agrocont::lands.form.Dont have an land?')}} <a
                                                href="{{ route('agrocont.lands.create')}}"
                                                class="text-primary m-l-5"><b>{{trans('agrocont::lands.form.created')}}</b></a>
                                    </p>
                                </div>
                            </div>
                        @endif
                        <div class="clearfix"></div>

                    </div>
                </div>
            @if(count($lands))
                <!-- end card-box-->
                    <div class="row m-t-50">
                        <div class="col-sm-12 text-center">
                            <p class="text-muted">{{ trans('agrocont::lands.form.Dont have an land?')}} <a
                                        href="{{ route('agrocont.lands.create')}}"
                                        class="text-primary m-l-5"><b>{{trans('agrocont::lands.form.created')}}</b></a>
                            </p>
                        </div>
                    </div>
                @endif
            </div>
            <!-- end wrapper -->
        </div>
    </div>
@stop