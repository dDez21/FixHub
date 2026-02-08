document.addEventListener('DOMContentLoaded', () => { //aspetto che documento sia caricato
    
    const users = document.querySelectorAll('.user-single'); //prendo tutti gli utenti
    if(!users.length) return; //se non ci sono utenti esco

    // prendo elementi card
    const nameUser = document.getElementById('user-name'); //nome utente
    const surnameUser = document.getElementById('user-surname'); //cognome utente
    const roleUser = document.getElementById('user-role'); //ruolo utente
    const usernameUser = document.getElementById('user-username'); //username utente
    const techBox = document.getElementById('tech-data');
    const techCenter = document.getElementById('user-tech-center'); //centro tecnico
    const techCategories = document.getElementById('user-tech-categories'); //categorie tecnico



    function roleLabel(role){
    if (role === 'admin') return 'Admin';
    if (role === 'tech') return 'Tecnico';
    if (role === 'staff') return 'Staff';
    return role || '';
    }

    async function fetchTechDetails(el){
        const url = el.dataset.techUrl;
        if (!url) return null;

        try{
        const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' }});
        if (!res.ok) return null;
        return await res.json();
        }catch(e){
        console.error('Errore fetch tech:', e);
        return null;
        }
    }

    //prendo utente selezionato
    async function showUser(el){
        
        //metto i dati dell'utente selezionato nella card
        const name = el.dataset.name || '';
        const surname = el.dataset.surname || '';
        const role = el.dataset.role || '';
        const username = el.dataset.username || '';

        //controllo sui dati
        if(nameUser) nameUser.textContent = name || '';
        if(surnameUser) surnameUser.textContent = surname || '';
        if (roleUser) roleUser.textContent = role ? `Ruolo: ${roleLabel(role)}` : '';
        if (usernameUser) usernameUser.textContent = `Username: ${username || ''}`;
        
        //evito rimanga presente sezione tecnico
        if (techBox) techBox.style.display = 'none';
        if (techCenter) techCenter.textContent = '';
        if (techCategories) techCategories.textContent = '';
        
        //mostro se tecnico
        if (role === 'tech'){
            const data = await fetchTechDetails(el);

            if (data && data.tech) {
                if (techBox) techBox.style.display = 'block';

                const centerName = data.tech.center || '';
                const categories = data.tech.categories || [];

                if (techCenter) techCenter.textContent = centerName ? `Centro: ${centerName}` : 'Centro: Nessun centro associato';
                if (techCategories) techCategories.textContent = categories.length ? `Categorie: ${categories.join(', ')}` : '';
            }
        }
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