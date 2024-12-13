document.addEventListener('DOMContentLoaded', function() {
    // Logique pour l'interface de la radio
    const radioInterface = document.getElementById('radio-interface');
    if (radioInterface) {
        // Ajouter ici la logique pour l'interface de la radio
    }

    // Logique pour le logbook
    const saveEntryButton = document.getElementById('save-entry');
    if (saveEntryButton) {
        saveEntryButton.addEventListener('click', function() {
            const logbookEntry = document.getElementById('logbook-entry').value;
            const entriesDiv = document.getElementById('entries');
            const newEntry = document.createElement('p');
            newEntry.textContent = logbookEntry;
            entriesDiv.appendChild(newEntry);
            document.getElementById('logbook-entry').value = '';
        });
    }
});