<!DOCTYPE HTML>
<html>
	<head>
		<script src="{{ URL::asset('phaser.min.js') }}"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<title>DWA - P4</title>
	</head>
	
	<style>
		body{
			background-color: #FF0000;
		}
	</style>
	
	<body>
		<?php	
			$user = Auth::user();
	
		    if($user) {
				
				//get user info
				$uArray = $user->toArray();
				
				$uid = $user['id'];
				$outfit =  $user['outfit'];
				$money =  $user['money'];
				$updates = $user['updates'];
				
				$outfits = explode(",", $outfit);
				
				$intBool = false;
				
				//get url form info if it exists
				if (!empty($_GET['moneyVar'])){
					$money = $_GET['moneyVar'];
					$affected = DB::update('update users set money = '.$money.' where id = '.$uid);
				}
				if (!empty($_GET['hat']) || !empty($_GET['body'])){
					if (empty($_GET['body'])){
						$outfit = '"'.$_GET['hat'].','.$outfits[1].'"';
						$outfits[0] = $_GET['hat'];
						$affected = DB::update('update users set outfit = '.$outfit.' where id = '.$uid);
					}
					else if (empty($_GET['hat'])){
						$outfit = '"'.$outfits[0].','.$_GET['body'].'"';
						$outfits[1] = $_GET['body'];
						$affected = DB::update('update users set outfit = '.$outfit.' where id = '.$uid);
					}
					else{
						$outfit = '"'.$_GET['hat'].','.$_GET['body'].'"';
						$outfits[0] = $_GET['hat'];
						$outfits[1] = $_GET['body'];
						$affected = DB::update('update users set outfit = '.$outfit.' where id = '.$uid);
					}
				}
				if (!empty($_GET['bought'])){
					$bought = $_GET['bought'];
					$affected = DB::update('update users set items = CONCAT(items, "'.$bought.'") where id = '.$uid);
				}
	
				//generate random encounter
				$chance = rand(0, 100);
				
				$question = '';
				$ansa = '';
				$ansb = '';
				$ansc = '';
				$voutfits = array('0', '0');
				$vid = ' ';
				$qid = ' ';
					
				if ($chance <= 30){
					$ints = DB::select('select * from interactions ORDER BY RAND() LIMIT 1');
					$qid = $ints[0]->id;
					$question = $ints[0]->question;
					$ansa = $ints[0]->answ_a;
					$ansb = $ints[0]->answ_b;
					$ansc = $ints[0]->answ_c;
					
					$visits = DB::select('select * from users where id != '.$uid.' ORDER BY RAND() LIMIT 1');
					$vid = $visits[0]->id;
					$vout = $visits[0]->outfit;
					
					$voutfits = explode(",", $vout);
					
					$intBool = true;
				}
				
		    } else {
		        echo 'You are not logged in.';
		    }
				
		?>
			
		<script type="text/javascript">
			
		    window.onload = function() {
		
		        var game = new Phaser.Game(1280, 720, Phaser.CANVAS, '', { preload: preload, create: create, update: update });
				
				var mvng = false;
				var btm = true;
				var top = false;
				var cloud;
				var score = <?php echo $money; ?>;
				var scoreString = '';
				var scoreText;
				
				var shopString = '';
				var shopText;
				
				var result = '';
				
				var intBool = <?php echo "'".$intBool."'"; ?>;

		        function preload () {
		        	
		        	game.load.image('cloud', '{{ URL::asset("background2.png") }}');
		        	game.load.image('tree', '{{ URL::asset("tree.png") }}');
		        	game.load.image('plyr', '{{ URL::asset("plyr.png") }}');
		        	game.load.image('shop', '{{ URL::asset("shop.png") }}');
		        	
		        	game.load.image('hat1', '{{ URL::asset("hat1.png") }}');
		        	game.load.image('hat2', '{{ URL::asset("hat2.png") }}');
		        	game.load.image('hat3', '{{ URL::asset("hat3.png") }}');
		        	game.load.image('body1', '{{ URL::asset("body1.png") }}');
		        	game.load.image('body2', '{{ URL::asset("body2.png") }}');
		        	game.load.image('body3', '{{ URL::asset("body3.png") }}');
		
		            this.game.stage.scale.pageAlignHorizontally = true;
					this.game.stage.scale.pageAlignVeritcally = true;
					this.game.stage.scale.refresh();
		
		
		        }
		
		        function create () {
		        	
		        	cloud = game.add.tileSprite(0, 0, 1300, 1300, 'cloud');
		        	
		        	tree = game.add.sprite(640, 200, 'tree');
		        	tree.angle = 45;
		        	
		        	var graphics = game.add.graphics(0, 0);
		        	
		        	//snowbank
		        	graphics.beginFill(0xFFFFFF);
		        	graphics.drawRect(0, 540, 1280, 720);
		        	graphics.endFill();
		        	
		        	window.graphics = graphics;
		
					plyr = game.add.sprite(640, 510, 'plyr');
					plyr.anchor.setTo(0.5, 0.5);
					
					//clothes logic
					if (<?php echo "'".$outfits[0]."'"; ?> == '1'){
						hat = game.add.sprite(639, 477, 'hat1');
					}
					if (<?php echo "'".$outfits[0]."'"; ?> == '2'){
						hat = game.add.sprite(639, 477, 'hat2');
					}
					if (<?php echo "'".$outfits[0]."'"; ?> == '3'){
						hat = game.add.sprite(639, 477, 'hat3');
					}
					hat.anchor.setTo(0.5, 0.5);
					
					if (<?php echo "'".$outfits[1]."'"; ?> == '1'){
						body = game.add.sprite(641, 513, 'body1');
					}
					if (<?php echo "'".$outfits[1]."'"; ?> == '2'){
						body = game.add.sprite(641, 513, 'body2');
					}
					if (<?php echo "'".$outfits[1]."'"; ?> == '3'){
						body = game.add.sprite(641, 513, 'body3');
					}
					body.anchor.setTo(0.5, 0.5);
					
					scoreString = 'Money : ';
   					scoreText = game.add.text(40, 30, scoreString + score, { font: '34px Arial', fill: '#000000' });
   					
					shopString = 'Shop';
					shopText = game.add.text(1160, 30, shopString, { font: '34px Arial', fill: '#000000' });
					
					shopLink = game.add.button(1160, 30, 'shop', openShop, this);
					
					killString = 'Kill';
					killText = game.add.text(1160, 656, killString, { font: '34px Arial', fill: '#000000' });
					killLink = game.add.button(1160, 656, 'shop', killChar, this);
					
				    game.input.onDown.add(onClick, this);
				    shopLink.input.priorityID = 0;
				    
				    //display interaction
				    if (intBool == true) {
					    graphics2 = game.add.graphics(0, 0);
			        	
			        	graphics2.beginFill(0xFFFFFF);
			        	graphics2.drawRect(0, 0, 1280, 720);
			        	graphics2.endFill();
			        	
			        	questionText = game.add.text(100, 100, <?php echo "'".$question."'"; ?>, { font: '34px Arial', fill: '#000000' });
			        	ansaText = game.add.text(200, 200, <?php echo "'".$ansa."'"; ?>, { font: '34px Arial', fill: '#000000' });
			        	ansbText = game.add.text(200, 300, <?php echo "'".$ansb."'"; ?>, { font: '34px Arial', fill: '#000000' });
			        	anscText = game.add.text(200, 400, <?php echo "'".$ansc."'"; ?>, { font: '34px Arial', fill: '#000000' });
			        	
			        	a = game.add.button(200, 200, 'shop', pickA, this);
			        	b = game.add.button(200, 300, 'shop', pickB, this);
			        	c = game.add.button(200, 400, 'shop', pickC, this);
					    a.scale.setTo(2, 1);
					    b.scale.setTo(2, 1);
					    c.scale.setTo(2, 1);
					    
					    vstr = game.add.sprite(800, 300, 'plyr');
					    
					    if (<?php echo "'".$voutfits[0]."'"; ?> == '1'){
							vhat = game.add.sprite(831, 311, 'hat1');
						}
						if (<?php echo "'".$voutfits[0]."'"; ?> == '2'){
							vhat = game.add.sprite(831, 311, 'hat2');
						}
						if (<?php echo "'".$voutfits[0]."'"; ?> == '3'){
							vhat = game.add.sprite(831, 311, 'hat3');
						}
						if (<?php echo "'".$voutfits[1]."'"; ?> == '1'){
							vbody = game.add.sprite(835, 340, 'body1');
						}
						if (<?php echo "'".$voutfits[1]."'"; ?> == '2'){
							vbody = game.add.sprite(835, 340, 'body2');
						}
						if (<?php echo "'".$voutfits[1]."'"; ?> == '3'){
							vbody = game.add.sprite(835, 340, 'body3');
						} 
					} 
		        }
				
				//animate the screen		        
				function update () {
					cloud.tilePosition.x += 2;
					cloud.tilePosition.y += 1;
					
					tree.body.x += 3;
					if (tree.body.x >= 1680){
						tree.body.x = -100;
					}
					
					cloud.angle += 5;
					
					if (mvng ==  true){
						if (btm == true){
							if (plyr.body.y == 350){
								btm = false;
								top = true;	
							}
							plyr.body.y -= 1;
							hat.body.y -= 1;
							body.body.y -= 1;
						}					
			        	else if(top == true){
			        		if (plyr.body.y == 460){
			        			btm = true;
			        			top = false;
			        			mvng = false;
			        		}
			        		plyr.body.y += 1;
			        		hat.body.y += 1;
							body.body.y += 1;
			        	} 
			        }
		        }
				
				function onClick () {
					
					if (mvng == false){
						score += 1;
				        scoreText.setText(scoreString + score);
					}
					
					mvng = true;
				}
				
				function openShop () {
					window.open("shop?moneyVar="+score+"&hat="+<?php echo $outfits[0]; ?>+"&body="+<?php echo $outfits[1]; ?>+"&uid="+<?php echo $uid; ?>+"&vid="+<?php echo $vid; ?>+"&qid="+<?php echo $qid; ?>+"&rid="+result, "_self");
				}
				
				function killChar () {
					window.open("logout?kill=1");
				}
				
				//delete the interaction assets.
				function pickA () {
					result = 'a';
					graphics2.destroy();
					questionText.destroy();
					ansaText.destroy();
					ansbText.destroy();
					anscText.destroy();
					a.destroy();
					b.destroy();
					c.destroy();
					vstr.destroy();
					vhat.destroy();
					vbody.destroy();
				}
				
				function pickB () {
					result = 'b';
					graphics2.destroy();
					questionText.destroy();
					ansaText.destroy();
					ansbText.destroy();
					anscText.destroy();
					a.destroy();
					b.destroy();
					c.destroy();
					vstr.destroy();
					vhat.destroy();
					vbody.destroy();
				}
				
				function pickC () {
					result = 'c';
					graphics2.destroy();
					questionText.destroy();
					ansaText.destroy();
					ansbText.destroy();
					anscText.destroy();
					a.destroy();
					b.destroy();
					c.destroy();
					vstr.destroy();
					vhat.destroy();
					vbody.destroy();
				}
		    };
	
	    </script>
	    
		
	</body>
	
</html>