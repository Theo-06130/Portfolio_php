document.addEventListener('DOMContentLoaded', () => {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';
    document.body.classList.toggle('dark-mode', isDarkMode);

    // Ajoutez un gestionnaire d'événements au bouton pour basculer entre les thèmes
    const toggleThemeButton = document.getElementById('toggle-theme-button');
    toggleThemeButton.addEventListener('click', toggleTheme);
});

// Fonction pour basculer entre les thèmes
function toggleTheme() {
    document.body.classList.toggle('dark-mode');

    // Mémoriser le choix de l'utilisateur dans le stockage local
    const isDarkMode = document.body.classList.contains('dark-mode');
    localStorage.setItem('darkMode', isDarkMode);
}

// Vérifier le stockage local pour le thème préféré de l'utilisateur
document.addEventListener('DOMContentLoaded', () => {
    const isDarkMode = localStorage.getItem('darkMode') === 'true';

    // Appliquer le thème en fonction du choix de l'utilisateur
    document.body.classList.toggle('dark-mode', isDarkMode);
});




