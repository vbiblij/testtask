@extends('layouts.panel')
<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \App\campaign $campaign */
?>
@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
            <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('campaign.index')}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-9 col-sm-7 col-xs-6">campaign: <b>{{$campaign->name}}</b></div>
            <div class="col-md-2 col-sm-3 col-xs-4">
                <div class="pull-right">
                    {{Form::open(['class' => 'confirm-delete', 'route' => ['campaign.destroy', $campaign->id], 'method' => 'DELETE'])}}
                    {{ link_to_route('campaign.edit', 'edit', [$campaign->id], ['class' => 'btn btn-primary btn-xs']) }} |
                    {{Form::button('Delete', ['class' => 'btn btn-danger btn-xs', 'type' => 'submit'])}}
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>

    <div class="panel-body">

        <table class="table table-bordered table-responsive">
			<tbody>
				<tr>
					<td>Subject</td> 
					<td>{{$campaign->name}}</td>
				</tr> 
				<tr>
					<td>To</td> 
					<td><b>{{$to}}</b></td>
				</tr> 
				<tr>
					<td>From</td> 
					<td>{{$from}}</td>
				</tr> 
				<tr>
					<td>Message</td> 
					<td><textarea name="" id="" cols="75" rows="10">{{$template->content}}</textarea></td>
				</tr>
			<tbody>	
        </table>
        <div class="pull-right">
            {{Form::open(['class' => 'confirm-send', 'route' => ['campaign.send', $campaign->id], 'method' => 'POST'])}}
            {{Form::button('Send', ['class' => 'btn btn-success btn-md', 'type' => 'submit'])}}
            {{Form::close()}}
        </div>
		
		<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>
			$().ready(function () {
				tinymce.init({
					menubar:false,
					statusbar: false,
					selector: 'textarea',
					height: 300,
					theme: 'modern',
					plugins: [
						'image imagetools'
					],
					toolbar1: 'none',
					relative_urls: false,
					file_browser_callback: function(field_name, url, type, win) {
						// trigger file upload form
						if (type == 'image') $('#formUpload input').click();
					}
				});
			});
		</script>
    </div>

@endsection