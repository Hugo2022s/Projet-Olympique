<base href="https://projetbloc3.com">
<?php require_once 'auth_check.php';?>
	<div class="login-form">
        <form method="post">
            <h2 class="login-title">Connexion au compte</h2>
			<div class="input-icons">
				<i class="fa-solid fa-envelope"></i>
                <input class="input-css" minlength="5" maxlength="23" name="login_email" type="email" placeholder="Email" required><br>
			</div>
			<div class="input-icons">
				<i class="fa-solid fa-lock"></i>
                <input class="input-css" minlength="5" maxlength="60" name="login_password" type="password" placeholder="Mot de Passe" required><br>
			</div>
            <button class="submitlogin" name="login" type="submit">Se Connecter</button><br>
			<div class="lien_connexion">
				<a href="inscription">Pas de compte?</a>
				<a href="admin">Administrateur?</a>
			</div>	
        </form>
	</div>     