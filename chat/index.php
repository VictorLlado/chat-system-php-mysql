<!DOCTYPE html>
<html lang= "en">
    <head>
    	<meta charset="utf-8">
        <title>CHAT</title>
        <link rel="stylesheet" type="text/css" href="style.css"/>
        <script
        src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    </head>
    <body>
	
    	<div id="wrapper">
    	<h1>HOLA SOY <?php session_start(); echo $_SESSION['username']; ?>!</h1>	
    		<div class="chat_wrapper">
    			<div id="chat"></div>
    			<form method="POST" id="messageFrm">
    				<textarea name="message" cols="30" rows="10" class="textarea"></textarea>
    			</form>
     		</div>
    	</div>

        <script>
        	LoadChat();
        	setInterval(function(){
                LoadChat();
        	}, 1000);
        	function LoadChat()
        	{
                $.post('handlers/messages.php?action=getMessages', function(response){
                    $('#chat').html(response); 
                    $('#chat').scrollTop( $('#chat').prop('scrollHeight') );                  
                });
        	}
        	$('.textarea').keyup(function(e){
        		if( e.which == 13 ){
        			$('form').submit();
        		}
        	});
        	$('form').submit(function(){
        		var message = $('.textarea').val();
                $.post('handlers/messages.php?action=sendMessage&message='+message, function(response){
                    if ( response==1 ) {
                    	LoadChat();
                    	document.getElementById('messageFrm').reset();
                    }
                });
                return false;
        	});
        </script>
    </body>
</html>
