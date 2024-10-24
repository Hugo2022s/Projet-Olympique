<base href="http://localhost">
<?php session_start(); ?>
<?php require_once 'auth_check.php';?>
	<div class="login-form">
        <form method="post">
            <h2 class="login-title">Créer un compte</h2>
			<div class="input-icons">
				<i class="fa-solid fa-user"></i>
				<input class="input-css" minlength="1" maxlength="20" name="name_register" type="text" placeholder="Nom" required><br>
			</div>	
			<div class="input-icons">
				<i class="fa-solid fa-signature"></i>
				<input class="input-css" minlength="1" maxlength="20" name="surname_register" type="text" placeholder="Prénom" required><br>
			</div>
			<div class="input-icons">
				<i class="fa-solid fa-envelope"></i>
                <input class="input-css" minlength="5" maxlength="23" name="email_register" type="email" placeholder="Email" required><br>
			</div>
			<div class="input-icons">
				<i class="fa-solid fa-lock"></i>
                <input class="input-css" minlength="5" maxlength="60" name="password_register" type="password" placeholder="Mot de Passe" required><br>
			</div>
			<div class="input-icons">
				<i class="fa-solid fa-lock"></i>
                <input class="input-css" minlength="5" maxlength="60" name="cPassword_register" type="password" placeholder="Vérifier Mot de Passe" required><br>
			</div>
            <button class="submitlogin" name="register" type="submit">S'inscrire</button><br>
			<a href="connexion">Déjà un compte?</a>
        </form>
	</div>