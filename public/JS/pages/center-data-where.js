document.addEventListener('DOMContentLoaded', () => { //aspetto che documento sia caricato

    const centers = document.querySelectorAll('.center-single'); //prendo tutti i centri
    if(!centers.length) return; //se non ci sono centri esco

    // prendo elementi card
    const nameCenter = document.getElementById('center-name'); //nome centro
    const addressCenter = document.getElementById('center-address'); //indirizzo centro
    const phoneCenter = document.getElementById('center-phone'); //telefono centro
    const emailCenter = document.getElementById('center-email'); //email centro
    const editLink = document.getElementById('center-edit-link');
    const deleteLink = document.getElementById('center-delete-link');

    //prendo centro selezionato
    function showCenter(el){
        
        //metto i dati del centro selezionato nella card
        const name = el.dataset.name || '';
        const region = el.dataset.region || '';
        const provincia = el.dataset.provincia || '';
        const address = el.dataset.address || '';
        const civic = el.dataset.civic || '';
        const city = el.dataset.city || '';
        const phone = el.dataset.phone || '';
        const email = el.dataset.email || '';
        if (editLink)   editLink.href = el.dataset.editUrl || '#';
        if (deleteLink) deleteLink.href = el.dataset.deleteUrl || '#';

        //controllo sui dati
        if(nameCenter) nameCenter.textContent = name || '';

        //costruisco indirizzo completo
        if(addressCenter){
            const totalAddress = `${address} ${civic} - ${city} (${provincia}), ${region}`;
            addressCenter.textContent = totalAddress;
        }

        if(phoneCenter) phoneCenter.textContent = phone ? `Telefono: +39 ${phone}` : '';
        if(emailCenter) emailCenter.textContent = email ? `Email: ${email}` : '';
    }


    //centro viene selezionato
    function selectCenter(el){

        //prende unicità selezione
        centers.forEach(c => c.classList.remove('is-selected'));
        el.classList.add('is-selected');
        
        //mostra dati centro selezionato
        showCenter(el);
    }


    //aggiungo evento click a tutti i centri
    centers.forEach(el => {
        el.addEventListener('click', () => selectCenter(el));

        // selezione anche da tastiera (Enter / Spazio)
        el.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                selectCenter(el);
                }
            });
    });

    selectCenter(centers[0]); //seleziono il primo centro di default
}); 