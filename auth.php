<?php
// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Enregistrer les erreurs dans un fichier de log
ini_set('log_errors', 1);
// Nom du fichier qui enregistre les logs (attention aux droits à l'écriture)
ini_set('error_log', dirname(__file__) . '/log_error_php.txt');
// Afficher les erreurs et les avertissements
error_reporting(1);


/*
 * Chargement des classes avec Composer
 */ 
	require 'vendor/autoload.php';
?>

<?php
	require_once 'connexion.php';
	/*
	 * Définit la variable globale user_id
	 */
	if(Auth::islog()){
		$email = Securite::bdd($_SESSION['Auth']['email']);
		$q     = array(
						'email' => $email
		);
		$sql   = 'SELECT user_id FROM users WHERE email = :email';
		$req   = $cnx->prepare($sql);
		$req->execute($q);
		// preparation de la variable user_id
		while($row = $req->fetch(PDO::FETCH_ASSOC)) {
			$user_id = Securite::bdd($row['user_id']);
		}
		global $user_id;
		$req->closeCursor();
	}
	/*
	 * Classe de vérification de connexion
	 */
	class Auth{
		static function islog(){
			global $cnx;
			if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['email']) && isset($_SESSION['Auth']['password'])){
				$q = array(
					'email'=>$_SESSION['Auth']['email'],
					'password'=>$_SESSION['Auth']['password']
				);
				$sql = 'SELECT email, pass, activer FROM users WHERE email = :email AND pass = :password AND activer = 1';
				$req = $cnx->prepare($sql);
				$req->execute($q);
				$count = $req->rowCount($sql);
				if($count == 1){
					return true;
				}else{
					return false;
				}
			}else{
				return false;
			}
		}
	}
	
	class Securite
	{
	    /*
		 * Données entrantes
		 */ 
	    public static function bdd($string)
	    {
	        // On regarde si le type de string est un nombre entier (int)
	        if(ctype_digit($string))
	        {
	            $string = intval($string);
	        }
	        // Pour tous les autres types
	        else
	        {
	            $string = mysql_real_escape_string($string);
	            $string = addcslashes($string, '%_');
	        }
	        return $string;
	    }
	    /*
		 * Données sortantes
		 */ 
	    public static function html($string)
	    {
	        return htmlentities($string);
	    	return $string;
	    }
	}
	
	/*
	 * Création de classes permettant l'utilisation de Securite::html pour l'affichage
	 */ 
	class Affichage
	{
		public static function comptes($classe)
		{
			if (Auth::islog()) {
				global $cnx;
				$sql = 'SELECT id_compte, numero, description, classe FROM comptes WHERE classe = :classe';
				$req = $cnx->prepare($sql);
				$req->bindParam(':classe', $classe, PDO::PARAM_INT);
				$req->execute();
	            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
					echo "<option value=\"".Securite::html($row['id_compte'])."\">".Securite::html($row['numero'])." - ".Securite::html($row['description'])."</option>";
	            }
	            $req->closeCursor();
            }
		}
		
		public static function favoris_comptes()
		{
			if (Auth::islog()) {
				global $cnx, $user_id;
				$sql = 'SELECT c.id_compte AS idCompte, c.numero AS numeroCompte, c.description AS descriptionCompte, fc.compte_id, fc.user_id, u.user_id
						FROM comptes c
						INNER JOIN favoris_comptes fc ON c.id_compte = fc.compte_id
						INNER JOIN users u ON u.user_id = fc.user_id
					 	WHERE u.user_id = :user_id';
				$req = $cnx->prepare($sql);
				$req->bindParam(':user_id', $user_id, PDO::PARAM_STR, 100);
				$req->execute();
				echo "<option value=\"0\">Sélectionner un compte</option>";
	            while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
					echo "<option value=\"".Securite::html($row['idCompte'])."\">".Securite::html($row['numeroCompte'])." - ".Securite::html($row['descriptionCompte'])."</option>";
	            }
	            $req->closeCursor();
            }
		}

		public static function code_analt()
		{
			if(Auth::islog()){
				global $cnx, $user_id;
				$sql = 'SELECT id_code_analt, description FROM codes_analytiques WHERE users_on = :user_id';
				$req = $cnx->prepare($sql);
				$req->bindParam(':user_id', $user_id, PDO::PARAM_STR, 100);
				$req->execute();
				echo "<option value=\"0\">Sélectionner un code analytique</option>";
				while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
					echo "<option value=\"".Securite::html($row['id_code_analt'])."\">" . Securite::html($row['description']) . "</option>";
				}
			}
		}
		
		public static function journaux()
		{
			if(Auth::islog()){
				global $cnx;
				$sql = 'SELECT id_journal, description FROM journaux';
				$req = $cnx->prepare($sql);
				$req->execute();
				echo "<option value=\"0\">Sélectionner un journal</option>";
				while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
					echo "<option value=\"".Securite::html($row['id_journal'])."\">" . Securite::html($row['description']) . "</option>";
				}
			}
		}
		
		public static function membres()
		{
			if(Auth::islog()){
				global $cnx, $user_id;
				$sql = 'SELECT prenom, nom, email, naissance, cotisation, fonction FROM membres WHERE users_on = :user_id';
				$req = $cnx->prepare($sql);
				$req->bindParam(':user_id', $user_id, PDO::PARAM_STR, 100);
				$req->execute($q);
				while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
					echo "<option>". Securite::html($row['prenom']) ."</option>";
				}
			}
		}
	}
?>