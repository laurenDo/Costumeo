<?php
if(isset($_POST['email'])) {
        $email_to = "lauren_d@etna-alternance.net";
        $email_subject = "Demande d'informations concernant l'achat de costumes";

        function died($error) {
        echo "Nous sommes desole, mais il y a eu des erreurs dans la completion du formulaire.";
        echo "Voici les erreurs.<br><br>";
        echo $error."<br><br>";
        echo "Veuillez corriger ces erreurs.<br><br>";
        die();
        }

        if(!isset($_POST['nom']) ||
           !isset($_POST['email']) ||
           !isset($_POST['message'])) {
           died('Il y a un probleme dans le formulaire envoye.');
        }

        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $errormessage = "";
        $email_reg = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        if(!preg_match($email_reg, $email)) {
        $errormessage = "L'addresse mail entree n'est pas valide.<br>";
        }
        $string_reg = "/^[A-Za-z\s.'-]+[A-Za-z\s.'-]$/";
        if(!preg_match($string_reg, $nom)) {
        $errormessage = "Le nom entre n'est pas bon";
        }
        if(strlen($message) < 120) {
        $errormessage = "Le message entre doit faire au minimum 120 caracteres."
   }
        if(strlen($errormessage) > 0) {
        died($errormessage);
        }

        $emailmess = "Details du formulaire plus bas.";
        function clean_string($string) {
        $bad = array("content-type", "bcc", "to:", "cc", "href");
        return str_replace($bad,"", $string);
        }

        $emailmess .= "Nom et prenom: ".clean_string($nom)."\n";
        $emailmess .= "Email :".clean_string($email)."\n";
        $emailmess .= "Message: ".clean_string($message)."\n";


        $headers = 'From: /'.$email."\r\n".
        'To: '.email."\r\v".
       'X-Mailer: PHP/'. phpversion();
        @mail($email_to, $email_subject, $emailmess, $headers);
        sleep(2);
        echo "<meta http-equip='refresh' content=\"0; url=http://index.html\">";
?>
<?php
}
?>
