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


    //mostro centro selezionato
    function showCenter(center){
        
        //imposto valori del centro
        const{
            name = '',
            region = '',
            provincia = '',
            address = '',
            civic = '',
            city = '',
            phone = '',
            email = '',
            editUrl = '',
            deleteUrl = ''
        } = center.dataset;


        //aggiorno nome centro
        if(nameCenter) nameCenter.textContent = name || '';

        //costruisco e aggiorno indirizzo
        if(addressCenter){
            addressCenter.textContent = `${address} ${civic} - ${city} (${provincia}), ${region}`;
        }

        //aggiorno tel e mail
        if(phoneCenter) phoneCenter.textContent = phone ? `Telefono: +39 ${phone}` : '';
        if(emailCenter) emailCenter.textContent = email ? `Email: ${email}` : '';
    }


    //centro viene selezionato
    function selectCenter(center){

        //tolgo stile selezione a tutti i centri
        centers.forEach(c => c.classList.remove('is-selected'));

        //do stile selezione a centro selezionato
        center.classList.add('is-selected');
        
        //mostra dati centro selezionato
        showCenter(center);
    }


    //aggiungo evento click a tutti i centri
    centers.forEach(center => {
        center.addEventListener('click', () => selectCenter(center));
    });

    selectCenter(centers[0]); //seleziono il primo centro di default
}); 