const Choix_id = document.getElementById("Choix_id");
function handleOperationChange() {
    let operationSelect = document.getElementById("operation");
    let selectedOption = operationSelect.options[operationSelect.selectedIndex].value;

    console.log("Option sélectionnée :", selectedOption);

    if (selectedOption === "Supprimer" || selectedOption === "Modifier") {
        console.log("Affichage de Choix_id et label_Choix_id");
        Choix_id.style.display = "inline";
    } else {
        console.log("Masquage de Choix_id et label_Choix_id");
        Choix_id.style.display = "none";
    }
}
