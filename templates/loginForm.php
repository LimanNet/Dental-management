<html>
<head>
	<title><?php echo $results['pageTitle']; ?></title>
</head>
<body>
      <form action="?action=login" method="post"">
        <input type="hidden" name="login" value="true" />

<?php if ( isset( $results['errorMessage'] ) ) { ?>
        <div id="errorMessage"><?php echo $results['errorMessage'] ?></div>
		<script>
			function func() { 
				document.getElementById('errorMessage').style.visibility='hidden';
			}
			setTimeout(func, 5000);
		</script>
<?php } ?>

        <ul>

          <li>
            <label for="docName">Ввелите номер мобильного телефона или свой электронный адресс:<br/></label>
            <input type="text" name="docName" id="docName" placeholder="Your admin username" required autofocus maxlength="50" />
          </li>

          <li>
            <label for="password">Ввелите пароль:</label>
            <input type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
          </li>

        </ul>

        <div class="buttons">
          <input type="submit" name="login" value="Login" />
        </div>

      </form>
</body>
</html>
