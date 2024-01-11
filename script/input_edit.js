const Choix_id = document.getElementById("Choix_id")
const label_Choix_id = document.getElementById("label_Choix_id")



function handleOperationChange() {
    let operationSelect = document.getElementById("operation");
    let selectedOption = operationSelect.options[operationSelect.selectedIndex].value;

    // Exemple : Si "Supprimer" est sélectionné, effectuez une action spécifique
    if (selectedOption === "Supprimer" || selectedOption==="Modifier") {
        label_Choix_id.style.display="inline"
        Choix_id.style.display="inline"
        // Ajoutez ici votre logique spécifique pour l'option "Supprimer"
    }
    else{
        Choix_id.style.display="none"
        label_Choix_id.style.display="none"
    }
}

// Ajoutez ici votre logique de validation du formulaire
function validateForm() {
    // Exemple : Vérifiez les champs de formulaire avant de soumettre
    let nom = document.getElementById("nom").value;
    if (nom === "") {
        alert("Le champ 'Nom' ne peut pas être vide");
        return false; // Empêche la soumission du formulaire
    }

    // Ajoutez d'autres validations selon vos besoins

    return true; // Autorise la soumission du formulaire
}