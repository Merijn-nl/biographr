<?php
include 'header.php';

// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}
?>

<!-- register form -->
<div class="login">
	<h2>Word gratis lid</h2>

	<form method="post" action="register.php" name="registerform">
		<table>
			<tbody>
		    <!-- the user name input field uses a HTML5 pattern check -->
				<tr>
					<td>    <label for="login_input_username">Gebruikersnaam</label></td>
					<td>    <input id="login_input_username" class="login_input" type="text" pattern="[a-zA-Z0-9]{2,64}" name="user_name" required /></td>
				</tr>
		    <!-- the email input field uses a HTML5 email type check -->
				<tr>
					<td>    <label for="login_input_email">E-mail adres</label></td>
					<td><input id="login_input_email" class="login_input" type="email" name="user_email" required /></td>
				</tr>
		
				<tr>
					<td>    <label for="login_input_password_new">Wachtwoord</label></td>
					<td>	<input id="login_input_password_new" class="login_input" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" /></td>
				</tr>
		
				<tr>
					<td>    <label for="login_input_password_repeat">Herhaal wachtwoord</label></td>
					<td>	<input id="login_input_password_repeat" class="login_input" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" /></td>
				</tr>
			</tbody>
		</table>
		<input type="submit"  name="register" value="Word lid" />
    </form>

<!-- backlink -->
	<a href="index.php">Terug naar de loginpagina</a>
</div>