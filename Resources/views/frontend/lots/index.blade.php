@extends('layouts.master')

@section('title')
    Lotes | @parent
@stop
@section('meta')
@stop

@section('pagetitle')
    Lotes @stop
@section('breadcrumb')
    <li>
        <a href="{{url('/')}}">Dashboard</a>
    </li>
    <li class="active">
        Lotes
    </li>
@stop
@section('content')
    <div class="row text-center">

        <div class="panel">

            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="m-b-30">
                            <a id="addToTable" href="{{route('agrocont.lots.create')}}"
                               class="btn btn-success waves-effect waves-light">Agregar <i
                                        class="mdi mdi-plus-circle-outline"></i></a>
                        </div>
                    </div>
                </div>

                <div class="">
                    <table class="table table-striped add-edit-table table-bordered" id="datatable-editable">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Estado</th>
                            <th>Area</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if (isset($lots))
                            @foreach ($lots as $lots)
                                <tr class="gradeX">
                                    <td>{{ $lots->id}}</td>
                                    <td>{{ $lots->name}}
                                    </td>
                                    <td>
                                          <span class="label {{ $lots->present()->statusLabelClass}}">
                                                {{ $lots->present()->status}}
                                            </span>
                                    </td>
                                    <td> {{ $lots->area}}</td>
                                    <td class="actions">
                                        <a href="{{route('agrocont.lots.edit',[$lost->id])}}" class="on-default edit-row"><i class="fa fa-pencil"></i></a>
                                        <a href="{{route('agrocont.lots.destroy',[$lost->id])}}" class="on-default remove-row"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end: page -->

        </div> <!-- end Panel -->


    </div>
    <!-- end row -->
@stop