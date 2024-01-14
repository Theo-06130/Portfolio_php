// const Choix_id = document.getElementById("Choix_id")
// const label_Choix_id = document.getElementById("label_Choix_id")
//
//
//
// function handleOperationChange() {
//     let operationSelect = document.getElementById("operation");
//     let selectedOption = operationSelect.options[operationSelect.selectedIndex].value;
//
//     // Exemple : Si "Supprimer" est sélectionné, effectuez une action spécifique
//     if (selectedOption === "Supprimer" || selectedOption==="Modifier") {
//         label_Choix_id.style.display="inline"
//         Choix_id.style.display="inline"
//         // Ajoutez ici votre logique spécifique pour l'option "Supprimer"
//     }
//     else{
//         Choix_id.style.display="none"
//         label_Choix_id.style.display="none"
//     }
// }


const Choix_id = document.getElementById("Choix_id");
const label_Choix_id = document.getElementById("label_Choix_id");

function handleOperationChange() {
    let operationSelect = document.getElementById("operation");
    let selectedOption = operationSelect.options[operationSelect.selectedIndex].value;

    console.log("Option sélectionnée :", selectedOption);

    if (selectedOption === "Supprimer" || selectedOption === "Modifier") {
        console.log("Affichage de Choix_id et label_Choix_id");
        label_Choix_id.style.display = "inline";
        Choix_id.style.display = "inline";
    } else {
        console.log("Masquage de Choix_id et label_Choix_id");
        Choix_id.style.display = "none";
        label_Choix_id.style.display = "none";
    }
}
