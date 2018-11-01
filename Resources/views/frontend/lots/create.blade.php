@extends('layouts.master')

@section('title')
    Crar Lotes | @parent
@stop
@section('meta')
@stop

@section('pagetitle')
    Crear Lote @stop
@section('breadcrumb')
    <li>
        <a href="{{url('/')}}">Dashboard</a>
    </li>
    <li class="active">
        Lote
    </li>
@stop
@section('content')
    <div class="row">

        <div class="panel">

            <div class="panel-body">
                <div class="row m-t-50">
                    {!! Form::open(['route' => ['agrocont.lots.store'], 'method' => 'post']) !!}
                    <div class="col-xs-12 col-sm-9 col-md-8">
                        <div class="p-20">
                            @include('partials.form-tab-headers')
                            <div class="tab-content">
                                <?php $i = 0; ?>
                                @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                                    <?php $i++; ?>
                                    <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                                        @include('agrocont::frontend.lots.partials.create-fields', ['lang' => $locale])
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group {{ $errors->has("area") ? ' has-error' : '' }}'">
                                <label>{{trans('agrocont::lots.form.area')}}</label>
                                <div>
                                    <input data-parsley-type="number" type="number"
                                           name="area"
                                           value="{{ old("area")}}"
                                           class="form-control" required
                                           placeholder="en Hetareas"/>
                                    {!! $errors->first("area", '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has("slope") ? ' has-error' : '' }}'">

                                <label class="control-label">{{trans('agrocont::lots.form.slope')}}</label>
                                <input id="slope" type="number" value="{{old('slope')}}" name="slope">
                                {!! $errors->first("slope", '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group {{ $errors->has("texture") ? ' has-error' : '' }}'">

                                <label class="control-label">{{trans('agrocont::lots.form.texture')}}</label>

                                @php
                                    $oldCat = array();
                                    $oldCat=old('texture');
                                @endphp

                                <select class="select2 form-control select2-multiple" name="texture" id="texture"
                                        multiple="multiple"
                                        data-placeholder="{{trans('agrocont::lots.form.select ')}} ...">
                                    <option value="1" @isset($oldCat) @if(in_array(1, $oldCat)) checked="checked" @endif @endisset>Arenoso</option>
                                    <option value="2" @isset($oldCat) @if(in_array(2, $oldCat)) checked="checked" @endif @endisset>Fanco</option>
                                    <option value="3" @isset($oldCat) @if(in_array(3, $oldCat)) checked="checked" @endif @endisset>Limoso</option>
                                    <option value="4" @isset($oldCat) @if(in_array(4, $oldCat)) checked="checked" @endif @endisset>Arcilloso</option>
                                </select>
                            </div>
                            <div class="form-group {{ $errors->has("thickness") ? ' has-error' : '' }}'">
                                <label>{{trans('agrocont::lots.form.thickness')}}</label>
                                <div>
                                    <input data-parsley-type="number" type="number"
                                           name="thickness"
                                           value="{{ old("thickness")}}"
                                           class="form-control" required
                                    />
                                    {!! $errors->first("thickness", '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="form-group m-b-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-default waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-4">
                        <div class="p-20">
                            <div class="form-group">
                                <label>Estado *:</label>

                                <div class="radio">
                                    <input type="radio" name="status" id="statusI" value="0" {{ old('status',0) == 0? 'checked' : '' }}>
                                    <label for="status">
                                        Inactivo
                                    </label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="status" id="statusA" value="1" {{ old('status',0) == 1? 'checked' : '' }}>
                                    <label for="status">
                                        Activo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <!-- end: page -->

        </div> <!-- end Panel -->


    </div>
    <!-- end row -->
@stop


@section('scripts')
    @parent
    <script>
        jQuery(document).ready(function () {
            $("input[name='slope']").TouchSpin({
                min: 0,
                max: 100,
                step: 1,
                decimals: 0,
                boostat: 1,
                buttondown_class: "btn btn-custom",
                buttonup_class: "btn btn-custom",
                maxboostedstep: 100,
                postfix: '%'
            });
            $("input[name='thickness']").TouchSpin({
                min: 0,
                max: 100000,
                step: 1,
                decimals: 0,
                boostat: 1,
                buttondown_class: "btn btn-custom",
                buttonup_class: "btn btn-custom",
                maxboostedstep: 100,
                postfix: 'cm'
            });
            $(".select2").select2();
        });
    </script>

@stop








