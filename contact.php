<?php 
session_start(); 
$title = "Contact Family Page";
$description = "Family, Contact, Family, Contact, Family, Contact, Family, Contact";
include 'header.php';

// initialise les variables avec des valeurs vides
$civilityErr = $lastNameErr = $firstNameErr = $emailErr = $didYouSayFamilyErr = $familyErr = "";
$civility = $lastName = $firstName = $email = $didYouSayFamily = $family = "";

// fonction qui assainie les données des inputs grace au fonctions intégrées à php.
function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);// ****htmlspecialchars**** Sert à échapper les caractères spéciale de html et javascript pour éviter les injections et le cross site scripting -->
    return $data;
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //filter_has_var() vérifie si une variable POST est valide
    if (!filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || !filter_has_var(INPUT_POST, "civility") || empty($_POST["civility"])){
        $civilityErr = "la civilité est requise";
    } else {
        $civility = testInput($_POST["civility"]);
    }
    
    if (!filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || !filter_has_var(INPUT_POST, "lastName") || empty($_POST["lastName"])){
        $lastNameErr = "le nom est requis";
    } else {
        $lastName = testInput($_POST["lastName"]);
    }

    if (!filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || !filter_has_var(INPUT_POST, "firstName") || empty($_POST["firstName"])){
        $firstNameErr = "le prénom est requis";
    } else {
        $firstName = testInput($_POST["firstName"]);
    }

    // filter_input() Sert à filtrer une variable d'un certaint type (si elle est valide ou sert à l'assainir).
    if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL) || !filter_has_var(INPUT_POST, "email") || empty($_POST["email"])){
        $emailErr = "l'email' est requis";
    } else {
        $email = testInput($_POST["email"]);
    }
    
    if (!filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || !filter_has_var(INPUT_POST, "didYouSayFamily") || empty($_POST["didYouSayFamily"])){
        $didYouSayFamilyErr = "did you say family?";
    } else {
        $didYouSayFamily = testInput($_POST["didYouSayFamily"]);
    }
    
    if (!filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS) || !filter_has_var(INPUT_POST, "family") || empty($_POST["family"]) || strlen($_POST["family"]) < 5){
        $familyErr = "la famille est requise et doit contenir plus de 5 caractères";
    } else {
        $family = testInput($_POST["family"]);
    }
}

// enregistre dans session un tableau de clé/valeurs 
$_SESSION['formData'] = [
    'civility' => $civility,
    'lastName' => $lastName,
    'firstName' => $firstName,
    'email' => $email,
    'didYouSayFamily' => $didYouSayFamily,
    'family' => $family
];

// récupère les valeurs de session dans les variables si elle existent.
$civility = isset($_SESSION['formData']['civility']) ? $_SESSION['formData']['civility'] : '';
$lastName = isset($_SESSION['formData']['lastName']) ? $_SESSION['formData']['lastName'] : '';
$firstName = isset($_SESSION['formData']['firstName']) ? $_SESSION['formData']['firstName'] : '';
$email = isset($_SESSION['formData']['email']) ? $_SESSION['formData']['email'] : '';
$didYouSayFamily = isset($_SESSION['formData']['didYouSayFamily']) ? $_SESSION['formData']['didYouSayFamily'] : '';
$family = isset($_SESSION['formData']['family']) ? $_SESSION['formData']['family'] : '';
?>


<main>
    <h1>Contact</h1>
    
    <form method="POST" action="index.php?page=contact">

        <label for="civility">civilité</label>
        <select name="civility" id="civility">
            <option value="monsieur" <?php echo ($civility == 'monsieur') ? 'selected' : ''; ?>>Monsieur</option>
            <option value="madame" <?php echo ($civility == 'madame') ? 'selected' : ''; ?>>Madame</option>
            <option value="hélicoptère de combat apache" <?php echo ($civility == 'hélicoptère de combat apache') ? 'selected' : ''; ?>>Hélicoptère de combat apache</option>
            <option value="méduse" <?php echo ($civility == 'méduse') ? 'selected' : ''; ?>>Méduse</option>
            <option value="domToretto" <?php echo ($civility == 'domToretto') ? 'selected' : ''; ?>>Dom Toretto</option>
        </select>
        <span class="error">* <?php echo $civilityErr;?></span>
        <br>

        <label for="lastName">Nom</label>
        <input type="text" id="lastName" name="lastName" placeholder="Nom..." value="<?php echo $lastName;?>">
        <span class="error">* <?php echo $lastNameErr;?></span>
        <br>


        <label for="firstName">Prénom</label>
        <input type="text" id="firstName" name="firstName" placeholder="Prénom..." value="<?php echo $firstName;?>">
        <span class="error">* <?php echo $firstNameErr;?></span>
        <br>

        <label for="email">Adresse Mail</label>
        <input type="email" id="email" name="email" placeholder="exemple@site.com..." value="<?php echo $email;?>">
        <span class="error">* <?php echo $emailErr;?></span>
        <br>

        
        <input type="radio" id="did" name="didYouSayFamily" value="did" <?php echo ($didYouSayFamily == 'did') ? 'checked' : ''; ?>>
        <label for="did">Did</label>
        <input type="radio" id="you" name="didYouSayFamily" value="you" <?php echo ($didYouSayFamily == 'you') ? 'checked' : ''; ?>>
        <label for="you">You</label>
        <input type="radio" id="say" name="didYouSayFamily" value="say" <?php echo ($didYouSayFamily == 'say') ? 'checked' : ''; ?>>
        <label for="say">Say</label>
        <input type="radio" id="family?" name="didYouSayFamily" value="family?" <?php echo ($didYouSayFamily == 'family?') ? 'checked' : ''; ?>>
        <label for="family?">Family?</label>
        <span class="error">* <?php echo $didYouSayFamilyErr;?></span>
        <br>

        <label for="family">Family
            <textarea class="formInputs textarea" id="family" name="family" placeholder="Family..."><?php echo $family;?></textarea>
        </label>
        <span class="error">* <?php echo $familyErr;?></span>
        <br>


        <input class="formButton" type="submit" value="Envoyer">

    </form>

    
</main>



<?php 

$isComplete = true;

foreach ($_SESSION['formData'] as $key => $value) { // Changed to use foreach loop for better readability
    if (empty($value)) {
        $isComplete = false;
        break;
    }
}


// sert à écrire les données des inputs dans un fichier.txt
if ($isComplete) {
    $formDataString = implode("\n", $_SESSION['formData']);// sert à séparer sauter des lignes. 
    file_put_contents('fichier.txt', $formDataString);//FILE_APPEND permet d'ajouter et pas de remplacer les données
}

include 'footer.php';
?>