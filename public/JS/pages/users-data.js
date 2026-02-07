document.addEventListener('DOMContentLoaded', () => { //aspetto che documento sia caricato
    
    const users = document.querySelectorAll('.user-single'); //prendo tutti gli utenti
    if(!users.length) return; //se non ci sono utenti esco

    // prendo elementi card
    const nameUser = document.getElementById('user-name'); //nome utente
    const surnameUser = document.getElementById('user-surname'); //cognome utente
    const roleUser = document.getElementById('user-role'); //ruolo utente
    const usernameUser = document.getElementById('user-username'); //username utente
    const passwordUser = document.getElementById('user-password'); //password utente

    //prendo utente selezionato
    function showUser(el){
        
        //metto i dati dell'utente selezionato nella card
        const name = el.dataset.name || '';
        const surname = el.dataset.surname || '';
        const role = el.dataset.role || '';
        const username = el.dataset.username || '';
        const password = el.dataset.password || '';

        //controllo sui dati
        if(nameUser) nameUser.textContent = name || '';
        if(surnameUser) surnameUser.textContent = surname || '';
        if(roleUser) roleUser.textContent = role || '';
        if(usernameUser) usernameUser.textContent = username || '';
        if(passwordUser) passwordUser.textContent = password ? `Password: ${password}` : '';
    }


    //utente viene selezionato
    function selectUser(el){

        //prende unicità selezione
        users.forEach(c => c.classList.remove('is-selected'));
        el.classList.add('is-selected');
        
        //mostra dati utente selezionato
        showUser(el);
    }


    //aggiungo evento click a tutti gli utenti
    users.forEach(el => {
        el.addEventListener('click', () => selectUser(el));

        // selezione anche da tastiera (Enter / Spazio)
        el.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                selectUser(el);
                }
            });
    });

    selectUser(users[0]); //seleziono il primo utente di default
});