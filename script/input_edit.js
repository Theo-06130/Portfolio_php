    const operationSelect = document.getElementById('operation');
    const nomInput = document.getElementById('nom');
    const nomLabel = document.getElementById('nom-label');
    const descriptionInput = document.getElementById('description');
    const descriptionLabel = document.getElementById('description-label');
    const langageInput = document.getElementById('langage');
    const langageLabel = document.getElementById('langage-label');
    const collaborateurInput = document.getElementById('collaborateur');
    const collaborateurLabel = document.getElementById('collaborateur-label');
    const dateStartInput = document.getElementById('date_start');
    const dateStartLabel = document.getElementById('date_start-label');
    const dateEndInput = document.getElementById('date_end');
    const dateEndLabel = document.getElementById('date_end-label');
    const idThemeInput = document.getElementById('id_theme');
    const idThemeLabel = document.getElementById('id_theme-label');

    function handleOptionChange() {
    const operation = operationSelect.value;

    // Réinitialisez tous les styles d'affichage
    resetStyles();

    switch (operation) {
    case 'Ajouter':
    // Affichez les champs nécessaires pour Ajouter
    showField(nomInput, nomLabel);
    showField(descriptionInput, descriptionLabel);
    showField(langageInput, langageLabel);
    showField(collaborateurInput, collaborateurLabel);
    showField(dateStartInput, dateStartLabel);
    showField(dateEndInput, dateEndLabel);
    showField(idThemeInput, idThemeLabel);
    break;
    case 'Modifier':
    // Affichez les champs nécessaires pour Modifier
    // ...
    break;
    case 'Supprimer':
    // Affichez les champs nécessaires pour Supprimer
    // ...
    break;
    case 'Afficher':
    // Affichez les champs nécessaires pour Afficher
    // ...
    break;
    default:
    alert('Veuillez choisir une option');
    break;
}
}

    function resetStyles() {
    hideField(nomInput, nomLabel);
    hideField(descriptionInput, descriptionLabel);
    hideField(langageInput, langageLabel);
    hideField(collaborateurInput, collaborateurLabel);
    hideField(dateStartInput, dateStartLabel);
    hideField(dateEndInput, dateEndLabel);
    hideField(idThemeInput, idThemeLabel);
}

    function showField(input, label) {
    input.style.display = 'inline';
    label.style.display = 'inline';
}

    function hideField(input, label) {
    input.style.display = 'none';
    label.style.display = 'none';
}

    function checkForm() {
    // Vous pouvez ajouter d'autres vérifications ici si nécessaire
    return true
}
