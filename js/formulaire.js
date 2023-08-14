window.onload = function () {
  //Verifier que le champ pseudo est rempli

  const checkPseudo = () => {
    const pseudo = document.getElementById("pseudo").value.trim();
    const errorPseudoMessage = document.getElementById("errorPseudo");

    // Réinitialiser le message d'erreur précédent
    errorPseudoMessage.textContent = "";

    if (pseudo === "") {
      errorPseudoMessage.textContent = "Le champ pseudo ne peut pas être vide.";
      return false;
    } else if (pseudo.length > 20) {
      errorPseudoMessage.textContent =
        "Le champ pseudo ne peut contenir plus de 20 caractères.";
      return false;
    }
    return true;
  };
  //Verifier que le champ nom est rempli

  const checkName = () => {
    const name = document.getElementById("nom").value.trim();
    const errorNameMessage = document.getElementById("errorName");
    const nameRegex = /^[A-Za-z\s\-]+-$/;

    // Réinitialiser le message d'erreur précédent
    errorNameMessage.textContent = "";

    if (name === "") {
      errorNameMessage.textContent = "Le champ nom ne peut pas être vide.";
      return false;
    } else if (name.length > 20) {
      errorNameMessage.textContent =
        "Le champ nom ne peut contenir plus de 20 caractères.";
      return false;
    } else if (nameRegex.test(name)) {
      errorNameMessage.textContent =
        "Le nom ne peut contenir des caractères spéciaux.";
      return false;
    }
    return true;
  };
  //Verifier que le champ prenom est rempli

  const checkFirstName = () => {
    const firstName = document.getElementById("prenom").value.trim();
    const errorFirstNameMessage = document.getElementById("errorFirstName");
    const firstNameRegex = /^[A-Za-z\s\-]+$/;

    // Réinitialiser le message d'erreur précédent
    errorFirstNameMessage.textContent = "";

    if (firstName === "") {
      errorFirstNameMessage.textContent =
        "Le champ prénom ne peut pas être vide.";
      return false;
    } else if (firstName.length > 20) {
      errorFirstNameMessage.textContent =
        "Le champ prénom ne peut contenir plus de 20 caractères.";
      return false;
    } else if (!firstNameRegex.test(firstName)) {
      errorFirstNameMessage.textContent =
        "Le prénom ne peut contenir des caractères spéciaux.";
      return false;
    }
    return true;
  };
  const checkAdress = () => {
    const adress = document.getElementById("adresse").value.trim();
    const errorAdressMessage = document.getElementById("errorAdress");
    const adressRegex = /^[A-Za-z\s\-\.\,\0-9]+$/;

    // Réinitialiser le message d'erreur précédent
    errorAdressMessage.textContent = "";

    if (adress === "") {
      errorAdressMessage.textContent = "L'adresse ne peut pas être vide.";
      return false;
    } else if (!adressRegex.test(adress)) {
      errorAdressMessage.textContent =
        "L'adresse ne peut contenir certains de ces caractères.";
      return false;
    }
    return true;
  };
  const checkTown = () => {
    const town = document.getElementById("ville").value.trim();
    const errorTownMessage = document.getElementById("errorTown");
    const townRegex = /^[A-Za-z\s\-]+$/;

    // Réinitialiser le message d'erreur précédent
    errorTownMessage.textContent = "";

    if (town === "") {
      errorTownMessage.textContent = "Le champ ville ne peut pas être vide.";
      return false;
    } else if (town.length > 20) {
      errorTownMessage.textContent =
        "Le champ ville ne peut contenir plus de 20 caractères.";
      return false;
    } else if (!townRegex.test(town)) {
      errorTownMessage.textContent =
        "La ville ne peut contenir des caractères spéciaux.";
      return false;
    }
    return true;
  };
  const checkPostCode = () => {
    const cp = document.getElementById("cp").value.trim();
    const errorCpMessage = document.getElementById("errorCp");

    // Réinitialiser le message d'erreur précédent
    errorCpMessage.textContent = "";

    if (cp === "") {
      errorCpMessage.textContent = "Vous devez renseigner le code postal.";
      return false;
    } else if (cp.length > 5) {
      errorCpMessage.textContent = "Le code postal doit contenir 5 caractères.";
      return false;
    } else if (isNaN(cp)) {
      errorCpMessage.textContent = "Un code postal est composé de 5 chiffres.";
      return false;
    }
    return true;
  };
  const checkPhone = () => {
    const phone = document.getElementById("tel").value.trim();
    const errorPhoneMessage = document.getElementById("errorPhone");

    // Réinitialiser le message d'erreur précédent
    errorPhoneMessage.textContent = "";

    if (phone !== "" && phone.length !== 10) {
      errorPhoneMessage.textContent =
        "Le numéro de téléphone doit contenir 10 chiffres.";
      return false;
    } else if (isNaN(phone)) {
      errorPhoneMessage.textContent =
        "Un numéro de téléphone est composé de 10 chiffres.";
      return false;
    }
    return true;
  };
  const checkMail = () => {
    const mail = document.getElementById("email").value.trim();
    const errorMailMessage = document.getElementById("errorMail");
    const mailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // Réinitialiser le message d'erreur précédent
    errorMailMessage.textContent = "";

    if (mail === "") {
      errorMailMessage.textContent = "L'e-mail doit être rnseigné.";
      return false;
    } else if (!mailRegex.test(mail)) {
      errorMailMessage.textContent = "L'adresse e-mail doit être conforme.";
      return false;
    }
    return true;
  };
  const checkPassword = () => {
    const password = document.getElementById("mdp").value.trim();
    const errorPasswordMessage = document.getElementById("errorPassword");
    const passwordRegex = /^(?=.*[A-Z])(?=.*\d).{8,}$/;

    // Réinitialiser le message d'erreur précédent
    errorPasswordMessage.textContent = "";

    if (password === "") {
      errorPasswordMessage.textContent = "Vous devez créer un mot de passe.";
      return false;
    } else if (password.length < 8) {
      errorPasswordMessage.textContent =
        "Le mot de passe doit comprendre au moins 8 caractères.";
      return false;
    } else if (!passwordRegex.test(password)) {
      errorPasswordMessage.textContent =
        "Le mot de passe doit contenir au moins une majusule et un chiffre.";
      return false;
    }
    return true;
  };
  const checkConfirmPassword = () => {
    const password = document.getElementById("mdp").value.trim();
    const confirmPassword = document.getElementById("confirmMdp").value.trim();
    const errorConfirmPasswordMessage = document.getElementById(
      "errorConfirmPassword"
    );

    // Réinitialiser le message d'erreur précédent
    errorConfirmPasswordMessage.textContent = "";

    if (confirmPassword !== password) {
      errorConfirmPasswordMessage.textContent =
        "Les mots de passe ne correspondent pas.";
      return false;
    } else {
      errorConfirmPasswordMessage.textContent = "";
      return true;
    }
  };

  const validateForm = () => {
    const pseudoValid = checkPseudo();
    const nameValid = checkName();
    const firstNameValid = checkFirstName();
    const adressValid = checkAdress();
    const townValid = checkTown();
    const codeValid = checkPostCode();
    const phoneValid = checkPhone();
    const mailValid = checkMail();
    const passwordValid = checkPassword();
    const confirmPasswordValid = checkConfirmPassword();

    return (
      pseudoValid &&
      nameValid &&
      firstNameValid &&
      adressValid &&
      townValid &&
      codeValid &&
      phoneValid &&
      mailValid &&
      passwordValid &&
      confirmPasswordValid
    );
  };
  document.getElementById("pseudo").addEventListener("blur", checkPseudo);
  document.getElementById("nom").addEventListener("blur", checkName);
  document.getElementById("prenom").addEventListener("blur", checkFirstName);
  document.getElementById("adresse").addEventListener("blur", checkAdress);
  document.getElementById("ville").addEventListener("blur", checkTown);
  document.getElementById("cp").addEventListener("blur", checkPostCode);
  document.getElementById("tel").addEventListener("blur", checkPhone);
  document.getElementById("email").addEventListener("blur", checkMail);
  document.getElementById("mdp").addEventListener("blur", checkPassword);
  document
    .getElementById("confirmMdp")
    .addEventListener("input", checkConfirmPassword);

  document.getElementById("form").addEventListener("submit", (event) => {
    event.preventDefault(); // Empêcher l'envoi du formulaire pour effectuer notre propre validation
    const isFormValid = validateForm();

    // Envoyer le formulaire si tout est valide
    if (isFormValid) {
      document.getElementById("form").submit();
    }
  });
};
