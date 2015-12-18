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
		
			<div class="front">
				<a href={!! URL::to('login') !!}>Login</a>
				<a href={!! URL::to('register') !!}>register</a>
			</div>
	
    </body>
</html>