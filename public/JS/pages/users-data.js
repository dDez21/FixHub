document.addEventListener('DOMContentLoaded', () => {
    const users = document.querySelectorAll('.user-single');
    if (!users.length) return;

    const nameUser = document.getElementById('user-name');
    const surnameUser = document.getElementById('user-surname');
    const roleUser = document.getElementById('user-role');
    const usernameUser = document.getElementById('user-username');

    const techBox = document.getElementById('tech-data');
    const techBirthdate = document.getElementById('user-tech-birthdate')
    const techCenter = document.getElementById('user-tech-center');
    const techSpecializations = document.getElementById('user-tech-specializations');

const techCenterAddress = document.getElementById('user-tech-center-address');
    const staffBox = document.getElementById('staff-data');
    const staffCategories = document.getElementById('user-staff-categories');

    const editLink = document.getElementById('user-edit-link');
    const deleteWrap = document.getElementById('delete-wrap');
    const deleteLink = document.getElementById('user-delete-link');


    //resetto dati extra tecnico
    function resetTechData(){
        
        // nascondo box tecnico
        if (techBox) techBox.style.display = 'none';

        //svuoto i dati
        if (techBirthdate) techBirthdate.textContent = '';
        if (techCenter) techCenter.textContent = '';
        if (techCenterAddress) techCenterAddress.textContent = '';
        if (techSpecializations) techSpecializations.textContent = '';
    }


    //resetto dati extra staff
    function resetStaffData(){
        
        //nascondo box staff
        if (staffBox) staffBox.style.display = 'none';

        //svuoto dati
        if (staffCategories) staffCategories.textContent = '';
    }




    //eseguo richiesta AJAX per recuperare dati staff e tech
    function fetchAjax(url, onSuccess) {
        
        //ho url non valido
        if (!url) return null;
 
        
        $.ajax({ //invio richiesta Ajax

            
            url: url, //url a cui fare richiesta

            type: 'GET', //metodo HTTP usato da richiesta

            dataType: 'json', //voglio risposta in Json

            //successo nella richiesta
            success: function(data){
                onSuccess(data);
            },

            //errore alla richiesta
            error: function (xhr, status, error) {
                console.error('Errore AJAX:', error);
            }
        })
    }


    //mostro i dati aggiornando alla scelta dell'utente
    function showUser(user) {

        const{
            name = '',
            surname = '',
            role = '',
            username = ''
        } = user.dataset;

        //aggiorno i dati nella card
        if (nameUser) nameUser.textContent = name;
        if (surnameUser) surnameUser.textContent = surname;
        if (roleUser) roleUser.textContent = role ? `Ruolo: ${role}` : '';
        if (usernameUser) usernameUser.textContent = `Username: ${username}`;

        // aggiorno link azioni
        if (editLink) editLink.href = user.dataset.editUrl || '#';
        if (deleteLink) deleteLink.href = user.dataset.deleteUrl || '#';

        
        //resetto ulteriori dati
        resetTechData();
        resetStaffData();
        

        // utente selezionato è tecnico
        if (role === 'tech') {

            //chiamata AJAX al controller dei dati del tecnico
            fetchAjax(user.dataset.techUrl, function (data) {
                
                //verifico esistenza risposta e dati del tecnico
                if (data && data.tech) {
                    
                    //mostro box tecnico
                    if (techBox) techBox.style.display = 'block';
                    
                    //recupero dati tecnico
                    const birthdate = data.tech.birthdate || '';
                    const centerName = data.tech.center || '';
                    const specializations = data.tech.specializations || '';
                
                    //aggiorno caselle con i dati
                    if (techBirthdate) techBirthdate.textContent = birthdate ? `Data di nascita: ${birthdate}`: 'Data di nascita: -';
                    if (techCenter) techCenter.textContent = centerName ? `Centro: ${centerName}` : 'Centro: Nessun centro associato';
                    if (techCenterAddress) {
            techCenterAddress.textContent = center?.address
                ? `Indirizzo: ${center.address}`
                : 'Indirizzo: -';
        }

                    if (techSpecializations) techSpecializations.textContent = specializations ? `Specializzazioni: ${specializations}` : 'Specializzazioni: -';
                }  
            });
        }


        //utente selezionato è staff
        if (role === 'staff') {
            
            //chiamata AJAX al controller dei dati staff
            fetchAjax(user.dataset.staffUrl, function (data) {
                
                //verifico esistenza risposta e dati staff
                if (data && data.staff) {

                    //mostro box staff
                    if (staffBox) staffBox.style.display = 'block';
                    
                    //recupero categorie e aggiorno la card
                    const categories = data.staff.categories || [];
                    if (staffCategories) staffCategories.textContent = categories.length ? `Categorie: ${categories.join(', ')}` : 'Categorie: -';
                }
            });
        }

        if (role === 'admin') {

            //nascondo bottone elimina
            deleteWrap.style.display = 'none';
        } else {

            //mostro bottone elimina
            deleteWrap.style.display = 'block';
        }
    }


    //selezione di un utente
    function selectUser(user) {

        //tolgo selezione a tutti e la do all'unico utente selezionato
        users.forEach(c => c.classList.remove('is-selected'));
        user.classList.add('is-selected');
        showUser(user);
    }


    //aggiungo eventi a tutti i membri della lista utenti
    users.forEach(user => {
        user.addEventListener('click', () => selectUser(user));
    });


    //seleziono di default primo utente
    selectUser(users[0]);
});
