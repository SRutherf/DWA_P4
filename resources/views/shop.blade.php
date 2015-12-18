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
		    	//get user data		
				$uArray = $user->toArray();
				
				$uid = $user['id'];
				$outfit =  $user['outfit'];
				$money =  $user['money'];
				
				$outfits = explode(",", $outfit);
				
				$itemNameList = array();
				$itemPriceList = array();
				$items = DB::select('select * from items');
				foreach($items as $id) {
					array_push($itemNameList, $id->name);
					array_push($itemPriceList, $id->price);
				}
				
				$itemList = array();
				$owned = DB::select('select * from users where id = '.$uid);
				foreach($owned as $id) {
					array_push($itemList, $id->items);
				}
				
				//get url info if it exists
				if (!empty($_GET['moneyVar'])){
					$money = $_GET['moneyVar'];
					$affected = DB::update('update users set money = '.$money.' where id = '.$uid);
				}
				
				if (!empty($_GET['rid'])){
					$vid = $_GET['vid'];
					$qid = $_GET['qid'];
					$rid = $_GET['rid'];
					$affected = DB::table('users_x_interactions')->insert(
						array('user_id' => $uid, 'visitor_id' => $vid, 'interaction_id' => $qid, 'result' => $rid)
					);
				}
				
				
		    } else {
		        echo 'You are not logged in.';
		    }
		?>
			
		<script type="text/javascript">
			
		    window.onload = function() {
		
		        var game = new Phaser.Game(1280, 720, Phaser.CANVAS, '', { preload: preload, create: create, update: update });
				
				var moneyString = 'Money: ';
				var shopString = 'Slope';
				
				var hat = <?php echo $outfits[0]; ?>;
				var body = <?php echo $outfits[1]; ?>;
				
				var hatString = 'Hats';
				var bodyString = 'Clothes';
				
				var hat1Price = <?php echo "'".$itemPriceList[0]."'"; ?>;
				var hat2Price = <?php echo "'".$itemPriceList[1]."'"; ?>;;
				var hat3Price = <?php echo "'".$itemPriceList[2]."'"; ?>;;
				
				var body1Price = <?php echo "'".$itemPriceList[3]."'"; ?>;;
				var body2Price = <?php echo "'".$itemPriceList[4]."'"; ?>;;
				var body3Price = <?php echo "'".$itemPriceList[5]."'"; ?>;;
				
				var hat1Name = <?php echo "'".$itemNameList[0]."'"; ?>;;
				var hat2Name = <?php echo "'".$itemNameList[1]."'"; ?>;;
				var hat3Name = <?php echo "'".$itemNameList[2]."'"; ?>;;
				
				var body1Name = <?php echo "'".$itemNameList[3]."'"; ?>;;
				var body2Name = <?php echo "'".$itemNameList[4]."'"; ?>;;
				var body3Name = <?php echo "'".$itemNameList[5]."'"; ?>;;
				
				var h1 = 'Buy';
				var h2 = 'Buy';
				var h3 = 'Buy';
				var b1 = 'Buy';
				var b2 = 'Buy';
				var b3 = 'Buy';
				
				var bought = '';
				
				if (<?php echo "'".$itemList[0]."'"; ?>.indexOf('hat1') > -1) {
					h1 = 'Equip';
				}
				if (<?php echo "'".$itemList[0]."'"; ?>.indexOf('hat2') > -1) {
					h2 = 'Equip';
				}
				if (<?php echo "'".$itemList[0]."'"; ?>.indexOf('hat3') > -1) {
					h3 = 'Equip';
				}
				if (<?php echo "'".$itemList[0]."'"; ?>.indexOf('body1') > -1) {
					b1 = 'Equip';
				}
				if (<?php echo "'".$itemList[0]."'"; ?>.indexOf('body2') > -1) {
					b2 = 'Equip';
				}
				if (<?php echo "'".$itemList[0]."'"; ?>.indexOf('body3') > -1) {
					b3 = 'Equip';
				}

				var money = <?php echo $money; ?>;
				

		        function preload () {
		        	
		        	game.load.image('hat1', '{{ URL::asset("hat1.png") }}');
		        	game.load.image('hat2', '{{ URL::asset("hat2.png") }}');
		        	game.load.image('hat3', '{{ URL::asset("hat3.png") }}');
		        	game.load.image('body1', '{{ URL::asset("body1.png") }}');
		        	game.load.image('body2', '{{ URL::asset("body2.png") }}');
		        	game.load.image('body3', '{{ URL::asset("body3.png") }}');
		        	game.load.image('button', '{{ URL::asset("shop.png") }}');
		
		            this.game.stage.scale.pageAlignHorizontally = true;
					this.game.stage.scale.pageAlignVeritcally = true;
					this.game.stage.scale.refresh();
		
		
		        }
		
		        function create () {
		        	
		        	//background
		        	var graphics = game.add.graphics(0, 0);
		        	graphics.beginFill(0xFFFFFF);
		        	graphics.drawRect(0, 0, 1280, 720);
		        	graphics.endFill();
		        	window.graphics = graphics;
		        	
				    hat1 = game.add.sprite(200, 200, 'hat1');
				    hat2 = game.add.sprite(200, 400, 'hat2');
				    hat3 = game.add.sprite(200, 600, 'hat3');
				    
				    body1 = game.add.sprite(700, 200, 'body1');
				    body2 = game.add.sprite(700, 400, 'body2');
				    body3 = game.add.sprite(700, 600, 'body3');
				    
				    moneyText = game.add.text(40, 30, moneyString + money, { font: '34px Arial', fill: '#000000' });
					shopText = game.add.text(1160, 30, shopString, { font: '34px Arial', fill: '#000000' });
				    
				    hatText = game.add.text(200, 100, hatString, { font: '34px Arial', fill: '#000000' });
				    bodyText = game.add.text(700, 100, bodyString, { font: '34px Arial', fill: '#000000' });
				    
				    hat1Text = game.add.text(80, 200, hat1Price, { font: '34px Arial', fill: '#000000' }); 
				    hat2Text = game.add.text(80, 400, hat2Price, { font: '34px Arial', fill: '#000000' });
				    hat3Text = game.add.text(80, 600, hat3Price, { font: '34px Arial', fill: '#000000' });
				    
				    body1Text = game.add.text(580, 200, body1Price, { font: '34px Arial', fill: '#000000' });
				    body2Text = game.add.text(580, 400, body2Price, { font: '34px Arial', fill: '#000000' });
				    body3Text = game.add.text(580, 600, body3Price, { font: '34px Arial', fill: '#000000' });
				    
				    hat1NameText = game.add.text(200, 250, hat1Name, { font: '24px Arial', fill: '#000000' });
				    hat2NameText = game.add.text(200, 450, hat2Name, { font: '24px Arial', fill: '#000000' });
				    hat3NameText = game.add.text(200, 650, hat3Name, { font: '24px Arial', fill: '#000000' });
				    
				    body1NameText = game.add.text(700, 250, body1Name, { font: '24px Arial', fill: '#000000' });
				    body2NameText = game.add.text(700, 450, body2Name, { font: '24px Arial', fill: '#000000' });
				    body3NameText = game.add.text(700, 650, body3Name, { font: '24px Arial', fill: '#000000' });
				    
				    //logic for equipped items
				    if (hat == 1){
				    	h1 = 'Equipped';
				    }
				    if (hat == 2){
				    	h2 = 'Equipped';
				    }
				    if (hat == 3){
				    	h3 = 'Equipped';
				    }
				    if (body == 1){
				    	b1 = 'Equipped';
				    }
				    if (body == 2){
				    	b2 = 'Equipped';
				    }
				    if (body == 3){
				    	b3 = 'Equipped';
				    }
				    
				    hat1Status = game.add.text(300, 200, h1, { font: '34px Arial', fill: '#000000' });
				    hat2Status = game.add.text(300, 400, h2, { font: '34px Arial', fill: '#000000' });
				    hat3Status = game.add.text(300, 600, h3, { font: '34px Arial', fill: '#000000' });
				    
				    body1Status = game.add.text(800, 200, b1, { font: '34px Arial', fill: '#000000' });
				    body2Status = game.add.text(800, 400, b2, { font: '34px Arial', fill: '#000000' });
				    body3Status = game.add.text(800, 600, b3, { font: '34px Arial', fill: '#000000' });
				    
				    shopLink1 = game.add.button(300, 200, 'button', handler1, this);
				    shopLink2 = game.add.button(300, 400, 'button', handler2, this);
				    shopLink3 = game.add.button(300, 600, 'button', handler3, this);
				    shopLink4 = game.add.button(800, 200, 'button', handler4, this);
				    shopLink5 = game.add.button(800, 400, 'button', handler5, this);
				    shopLink6 = game.add.button(800, 600, 'button', handler6, this);
				    
				    shopLink1.scale.setTo(1.5, 1);
				    shopLink2.scale.setTo(1.5, 1);
				    shopLink3.scale.setTo(1.5, 1);
				    shopLink4.scale.setTo(1.5, 1);
				    shopLink5.scale.setTo(1.5, 1);
				    shopLink6.scale.setTo(1.5, 1);
				    
				    shopLink = game.add.button(1160, 30, 'button', openSlope, this);
				    
		        }
				
				//no need for animations		        
				function update () {
					
		        }
				
				function openSlope () {
					window.open("slope?moneyVar="+money+"&hat="+hat+"&body="+body+"&bought="+bought, "_self");
				}
				
				//handlers for switching status text
				function handler1 () {
					if (hat1Status.text == 'Equipped'){
						//do nothing
					}
					else if (hat1Status.text == 'Equip'){
						hat1Status.setText('Equipped');
						hat = '1';
						
						if (hat2Status.text == 'Equipped'){
							hat2Status.setText('Equip');	
						}
						if (hat3Status.text == 'Equipped'){
							hat3Status.setText('Equip');
						}
						
					}
					else if (hat1Status.text == 'Buy'){
						hat1Status.setText('Equipped');
						hat = '1';
						
						if (hat2Status.text == 'Equipped'){
							hat2Status.setText('Equip');	
						}
						if (hat3Status.text == 'Equipped'){
							hat3Status.setText('Equip');
						}
					}
				}
				
				function handler2 () {
					if (hat2Status.text == 'Equipped'){
						//do nothing
					}
					else if (hat2Status.text == 'Equip'){
						hat2Status.setText('Equipped');
						hat = '2';
						
						if (hat1Status.text == 'Equipped'){
							hat1Status.setText('Equip');	
						}
						if (hat3Status.text == 'Equipped'){
							hat3Status.setText('Equip');
						}
						
					}
					else if (hat2Status.text == "Buy"){
						if (money >= 50){
							hat2Status.setText('Equipped');
							hat = '2';
							
							if (hat1Status.text == 'Equipped'){
								hat1Status.setText('Equip');	
							}
							if (hat3Status.text == 'Equipped'){
								hat3Status.setText('Equip');
							}
							money -= 50;
					        moneyText.setText(moneyString + money);
					        bought = bought+',hat2';
						}
					}
				}
				
				function handler3 () {
					if (hat3Status.text == 'Equipped'){
						//do nothing
					}
					else if (hat3Status.text == 'Equip'){
						hat3Status.setText('Equipped');
						hat = '3';
						
						if (hat2Status.text == 'Equipped'){
							hat2Status.setText('Equip');	
						}
						if (hat1Status.text == 'Equipped'){
							hat1Status.setText('Equip');
						}
						
					}
					else if (hat3Status.text == 'Buy'){
						if (money >= 1000){
							hat3Status.setText('Equipped');
							hat = '3';
							
							if (hat2Status.text == 'Equipped'){
								hat2Status.setText('Equip');	
							}
							if (hat1Status.text == 'Equipped'){
								hat1Status.setText('Equip');
							}
							money -= 1000;
					        moneyText.setText(moneyString + money);
					        bought = bought+',hat3';
						}
					}
				}
				
				function handler4 () {
					if (body1Status.text == 'Equipped'){
						//do nothing
					}
					else if (body1Status.text == 'Equip'){
						body1Status.setText('Equipped');
						body = '1';
							
						if (body2Status.text == 'Equipped'){
							body2Status.setText('Equip');	
						}
						if (body3Status.text == 'Equipped'){
							body3Status.setText('Equip');
						}
						
					}
					else if (body1Status.text == 'Buy'){
						body1Status.setText('Equipped');
						body = '1';
						
						if (body2Status.text == 'Equipped'){
							body2Status.setText('Equip');	
						}
						if (body3Status.text == 'Equipped'){
							body3Status.setText('Equip');
						}
						//money stuff
					}
				}
				
				function handler5 () {
					if (body2Status.text == 'Equipped'){
						//do nothing
					}
					else if (body2Status.text == 'Equip'){
						body2Status.setText('Equipped');
						body = '2';
						
						if (body1Status.text == 'Equipped'){
							body1Status.setText('Equip');	
						}
						if (body3Status.text == 'Equipped'){
							body3Status.setText('Equip');
						}
						
					}
					else if (body2Status.text == "Buy"){
						if (money >= 50){
							body2Status.setText('Equipped');
							body = '2';
						
							if (body1Status.text == 'Equipped'){
								body1Status.setText('Equip');	
							}
							if (body3Status.text == 'Equipped'){
								body3Status.setText('Equip');
							}
							money -= 50;
					        moneyText.setText(moneyString + money);
					        bought = bought+',body2';
						}
					}
				}
				
				function handler6 () {
					if (body3Status.text == 'Equipped'){
						//do nothing
					}
					else if (body3Status.text == 'Equip'){
						body3Status.setText('Equipped');
						body = '3';
						
						if (body2Status.text == 'Equipped'){
							body2Status.setText('Equip');	
						}
						if (body1Status.text == 'Equipped'){
							body1Status.setText('Equip');
						}
						
					}
					else if (body3Status.text == 'Buy'){
						if (money >= 1000){
							body3Status.setText('Equipped');
							body = '3';
						
							if (body2Status.text == 'Equipped'){
								body2Status.setText('Equip');	
							}
							if (body1Status.text == 'Equipped'){
								body1Status.setText('Equip');
							}
							
							money -= 1000;
					        moneyText.setText(moneyString + money);
					        bought = bought+',body3';
						}
					}
				}
		
		    };
	
	    </script>
	    
	</body>
	
</html>