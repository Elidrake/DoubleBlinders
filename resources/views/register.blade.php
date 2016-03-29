<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DoubleBlind</title>
  </head>

  <body style="padding:16px;">
			    <h2 class="centered">Create a new Account</h2>
					<br>
          @if(Session::has('message'))
            <div class="title">{!! Session::get('message') !!}</div>
          @endif
		<div class="" style="margin:auto; padding:16px; background-color:white; max-width:500px; border-radius:2px; box-shadow: 0px 3px 1px -2px rgba(0, 0, 0, 0.14), 0px 2px 2px 0px rgba(0, 0, 0, 0.098), 0px 1px 5px 0px rgba(0, 0, 0, 0.084);">
			{!! Form::open(array('url' => 'api/v1/account', 'class'=>'form-signup')) !!}

				<div class="form-group">
					{!! Form::label('email', 'Email') !!}
					{!! Form::text('email', null, array('class' => 'form-control','placeholder'=>'Email', 'style'=>'border-top:0px; border-left:0px; border-right:0px; border-radius:0px; width:100%; -webkit-box-shadow:none; box-shadow:none;')) !!}
				</div>

				<div class="form-group">
					{!! Form::label('password', 'Password') !!}
					{!! Form::password('password', array('class' => 'form-control','placeholder'=>'Password', 'style'=>'border-top:0px; border-left:0px; border-right:0px; border-radius:0px; width:100%; -webkit-box-shadow:none; box-shadow:none;')) !!}
				</div>

				<div class="form-group">
					{!! Form::label('passwordRt', 'Confirm Password') !!}
					{!! Form::password('passwordRt', array('class' => 'form-control','placeholder'=>'Confirm Password', 'style'=>'border-top:0px; border-left:0px; border-right:0px; border-radius:0px; width:100%; -webkit-box-shadow:none; box-shadow:none;')) !!}
				</div>

				<div class="form-group">
					{!! Form::label('name', 'Name') !!}
					{!! Form::text('name', null, array('class' => 'form-control','placeholder'=>'Name', 'style'=>'border-top:0px; border-left:0px; border-right:0px; border-radius:0px; width:100%; -webkit-box-shadow:none; box-shadow:none;')) !!}
				</div>

				<br>

				{!! Form::submit('Create Account', array('style'=>'border: 0px; background-color:white; padding:8px; text-align:right;'))!!}

			{!! Form::close() !!}

		</div>
		<br>
  </body>
</html>