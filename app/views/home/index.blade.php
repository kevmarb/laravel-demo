@extends('layouts.master')

@section('content')
	
	@if(Auth::guest())
		<h1>Welcome to laravel introduction</h1>
	@else 
		
		{{Form::open(array('url' => 'create/post'))}}
			
			<div class="form-group">
				{{Form::label('title', 'Title')}}
				{{Form::text('title', Input::old('title'),  array('placeholder'=>'Enter title', 'class' => 'form-control'))}}
			</div>
			<p class="error">{{$errors->first('title')}}</p>

			<div class="form-group">
				{{Form::label('content', 'Content')}}
				{{Form::textarea('content', Input::old('content'),  array('placeholder'=>'Enter content', 'class' => 'form-control'))}}
			</div>
			<p class="error">{{$errors->first('content')}}</p>
			
			{{Form::submit('Create!', array('class' => 'btn btn-success btn-lg btn-block'))}}
	
		{{Form::close()}}

		@foreach($posts as $post)
			<div class="well">

				<h3>{{{$post->title}}}</h3>

				<p>{{{$post->content}}}</p>

				@if($post->confirmed == 0) 

					<a href="{{URL::to('validPost/'.$post->id)}}" class="btn btn-success"> Confirm</a>
					<a href="{{URL::to('declinePost/'.$post->id)}}" class="btn btn-danger"> Decline</a>
				
				@endif
			</div>
		@endforeach
		{{$posts->links()}}
	@endif
@stop

@section('sidebar')
	
	@if(Auth::guest())
		<div class="well">
			<h3>Sign Up</h3>
			<hr>
			{{Form::open(array('url' => 'auth/signup'))}}
				<div class="form-group">
					{{Form::label('username', 'Username')}}
					{{Form::text('username', Input::old('username'),  array('placeholder'=>'Enter username', 'class' => 'form-control'))}}
				</div>
				<p class="error">{{$errors->first('username')}}</p>
				<div class="form-group">
					{{Form::label('email', 'E-Mail Address')}}
					{{Form::text('email', Input::old('email'),  array('placeholder'=>'Enter email', 'class' => 'form-control'))}}
				</div>
				<p class="error">{{$errors->first('email')}}</p>
				<div class="form-group">
					{{Form::label('password', 'Password')}}
					{{Form::password('password',  array('placeholder'=>'Enter password', 'class' => 'form-control'))}}
				</div>
				<p class="error">{{$errors->first('password')}}</p>
				{{Form::submit('Sign Up!', array('class' => 'btn btn-primary btn-lg btn-block'))}}
			{{Form::close()}}
		</div>
		<div class="well">
			<h3>Log In</h3>
			 <p class="auth-message error animated shake text-center {{Session::get('authError') ? 'active' : ''}}">
                {{Session::get('authError')}}
            </p>
			<hr>
			{{Form::open(array('url' => 'auth/login'))}}
				<div class="form-group">
					{{Form::label('email', 'E-Mail Address')}}
					{{Form::text('email', Input::old('email'),  array('placeholder'=>'Enter email', 'class' => 'form-control'))}}
				</div>
				<p class="error">{{$errors->first('email')}}</p>
				<div class="form-group">
					{{Form::label('password', 'Password')}}
					{{Form::password('password',  array('placeholder'=>'Enter password', 'class' => 'form-control'))}}
				</div>
				<p class="error">{{$errors->first('password')}}</p>
				{{Form::submit('Log In!', array('class' => 'btn btn-success btn-lg btn-block'))}}
			{{Form::close()}}
		</div>
	@else 
		
		Hello {{{Auth::user()->username}}}
		<a href="{{URL::to('logout')}}" class="btn btn-primary"> Log Out</a>

	
	@endif
	</div>
@stop