<!doctype html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>hello phaser!</title>
        <script src="{{ URL::asset('phaser.min.js') }}"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel='stylesheet' href='{{ URL::asset("home.css") }}'/>
    </head>
    <body>
	
			<div class="back">
			    <script type="text/javascript">
			
				    window.onload = function() {
				
				        var game = new Phaser.Game(1280, 720, Phaser.AUTO, '', { preload: preload, create: create });
				
				        function preload () {
				
				            game.load.image('logo', '{{ URL::asset("main.png") }}');
				            this.game.stage.scale.pageAlignHorizontally = true;
							this.game.stage.scale.pageAlignVeritcally = true;
							this.game.stage.scale.refresh();
				
				
				        }
				
				        function create () {
				
				            var logo = game.add.sprite(game.world.centerX, game.world.centerY, 'logo');
				            logo.anchor.setTo(0.5, 0.5);
				            
				        }
				        
				        function update () {
				        	
				        }
				
				    };
			
			    </script>
		    </div>
			
			<div class="f_front">		
				<p>Don't have an account? <a href='/register'>Register here...</a></p>
	
			    <h1>Login</h1>
			
			    @if(count($errors) > 0)
			        <ul class='errors'>
			            @foreach ($errors->all() as $error)
			                <li><span class='fa fa-exclamation-circle'></span> {{ $error }}</li>
			            @endforeach
			        </ul>
			    @endif
			
			    <form method='POST' action='/login'>
			
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			
			        <div class='form-group'>
			            <label for='email'>Email</label>
			            <input type='text' name='email' id='email' value='{{ old('email') }}'>
			        </div>
			
			        <div class='form-group'>
			            <label for='password'>Password</label>
			            <input type='password' name='password' id='password' value='{{ old('password') }}'>
			        </div>
			
			        <div class='form-group'>
			            <input type='checkbox' name='remember' id='remember'>
			            <label for='remember' class='checkboxLabel'>Remember me</label>
			        </div>
			
			        <button type='submit' class='btn btn-primary'>Login</button>
			
			    </form>
			</div>
	
    </body>
</html>