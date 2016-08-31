<!-- if you need user information, just put them into the $_SESSION variable and output them here -->
<?php $user_id = $_SESSION['user_id']; ?>
<p class="loginsmall">Welkom <?php echo $_SESSION['user_name']; ?><br />
<a href="index.php?logout">Logout</a></p>