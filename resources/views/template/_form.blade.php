<div class="form-group">
	{!!Form::label('name', 'Name') !!}
	{!!Form::text('name', null, ['class' => 'form-control']) !!}
	{!!Form::label('content', 'Content') !!}
	{!!Form::textarea('content', null, ['class' => 'form-control']) !!}
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
	$().ready(function () {
		tinymce.init({
			selector: 'textarea',
			height: 300,
			theme: 'modern',
			plugins: [
				'image imagetools'
			],
			toolbar1: 'styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
			relative_urls: false,
			file_browser_callback: function(field_name, url, type, win) {
				// trigger file upload form
				if (type == 'image') $('#formUpload input').click();
			}
		});
	});
</script>