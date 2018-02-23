@extends('layouts.panel')
<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\bunche $bunche */
?>
@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('bunche.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">bunche: <b>{{$bunche->name}}</b></div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['bunche.destroy', $bunche->id], 'method' => 'DELETE'])}}
                    {{ link_to_route('bunche.edit', 'edit', [$bunche->id], ['class' => 'btn btn-primary btn-xs']) }} |
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">
		{{ link_to_route('subscriber.create', 'create', [$bunche->id], ['class' => 'btn btn-info btn-xs']) }}
        <table class="table table-bordered table-responsive">
            <tr>
                <th width="25%">First Name</th>
                <th width="25%">Last Name</th>
                <th width="25%">Email</th>
                <th width="25%">Action</th>
            </tr>
            @foreach ($subscribers as $model)
				<tr>
					<td>{{$model->name}}</td>
                    <td>{{$model->soname}}</td>
                    <td>{{$model->email}}</td>
                    <td>
                        {{Form::open(['class' => 'confirm-delete', 'route' => ['subscriber.destroy', $bunche->id, $model->id], 'method' => 'DELETE'])}}
                        {{ link_to_route('subscriber.edit', 'edit', [$bunche->id, $model->id], ['class' => 'btn btn-success btn-xs']) }}
                        {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                        {{Form::close()}}
                    </td>
				</tr>
            @endforeach
        </table>

    </div>

@endsection