<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<style>
            bodu{
                color: #3c4b64;
                background-color: #ebedef;
                --color: #3c4b64;
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: row;
                flex-direction: row;
                min-height: 100vh;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 0.875rem;
            }
            .label{
             font-weight: bolder;
            }
		</style>
	</head>
	<body style="background: #f5f5f5;">
		<div style="background: #ffffff; border: solid 2px #cccccc; border-radius: 5px; font-family: sans-serif; font-size: 12px; line-height: 15px; margin:0 auto; max-width: 100%; padding: 15px 30px;">
			<p><h3>Desafio - Oliveria Trust</h3></p>
			<hr>
			@yield('content')
		</div>
	</body>
</html>

