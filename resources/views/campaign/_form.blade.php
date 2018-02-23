<div class="form-group">
	{!!Form::label('name', 'Name') !!}
	{!!Form::text('name', null, ['class' => 'form-control']) !!}
	{!!Form::label('template_id', 'Template') !!}
	{!!Form::select( 'template_id', \App\Template::getSelectList(), isset($campaign) ? $campaign->template_id : null, ['class' => 'form-control']) !!}
	{!!Form::label('bunche_id', 'List') !!}
	{!!Form::select( 'bunche_id', \App\Bunche::getSelectList(), isset($campaign) ? $campaign->bunche_id : null, ['class' => 'form-control']) !!}
	{!!Form::label('description', 'Description') !!}
	{!!Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>