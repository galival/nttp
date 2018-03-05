<?php
	
	require_once("/../func.php");
	//include_once("header.php");

	if (isset($results['errorMessage'])){
		$errorMessage = $results['errorMessage'];
	}

	echo <<<EOF
	<form class="loginForm" action="admin.php?action=login" method="post" style="width:50%">
		<input type="hidden" name="login" value="true"/>
		<div class="errorMessage">$errorMessage</div>

		<ul>
			<li>
				<label for="username">username: </label>
				<input type="text" name="username" id="username" required autofocus maxlength="20" />
			</li>

			<li>
				<label for="password">password: </label>
				<input type="text" name="password" id="password" required maxlength="20" />
			</li>
		</ul>

		<div class="buttons">
			<input type="submit" name="login" value="Login" />
		</div>

	</form>
EOF;

//include_once("footer.php");

?>
