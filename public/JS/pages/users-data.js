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
        if (techSpecializations) techSpecializations.textContent = '';
    }


    //resetto dati extra staff
    function resetStaffData(){
        
        //nascondo box staff
        if (staffBox) staffBox.style.display = 'none';

        //svuoto dati
        if (staffCategories) staffCategories.textContent = '';
    }




    //eseguo richiesta AJAX per staff e tech
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

        if (nameUser) nameUser.textContent = name;
        if (surnameUser) surnameUser.textContent = surname;
        if (roleUser) roleUser.textContent = role ? `Ruolo: ${role}` : '';
        if (usernameUser) usernameUser.textContent = `Username: ${username}`;

        // aggiorno link azioni (FIX “sempre stesso utente”)
        if (editLink) editLink.href = user.dataset.editUrl || '#';
        if (deleteLink) deleteLink.href = user.dataset.deleteUrl || '#';

        // reset box
        if (techBox) techBox.style.display = 'none';
        if (techCenter) techCenter.textContent = '';
        if (techCategories) techCategories.textContent = '';

        if (staffBox) staffBox.style.display = 'none';
        if (staffCategories) staffCategories.textContent = '';

        // TECH details
        if (role === 'tech') {
        const data = await fetchJson(user.dataset.techUrl);
        if (data && data.tech) {
            if (techBox) techBox.style.display = 'block';
            const centerName = data.tech.center || '';
            const categories = data.tech.categories || [];
            if (techCenter) techCenter.textContent = centerName ? `Centro: ${centerName}` : 'Centro: Nessun centro associato';
            if (techCategories) techCategories.textContent = categories.length ? `Categorie: ${categories.join(', ')}` : '';
        }
        }

        // STAFF details
        if (role === 'staff') {
        const data = await fetchJson(user.dataset.staffUrl);
        if (data && data.staff) {
            if (staffBox) staffBox.style.display = 'block';
            const categories = data.staff.categories || [];
            if (staffCategories) staffCategories.textContent = categories.length ? `Categorie: ${categories.join(', ')}` : 'Categorie: -';
        }
        }

        if (role === 'admin') {
            deleteWrap.style.display = 'none';
        } else {
            deleteWrap.style.display = 'block';
        }
    }

    function selectUser(user) {
        users.forEach(c => c.classList.remove('is-selected'));
        user.classList.add('is-selected');
        showUser(user);
    }

    users.forEach(user => {
        user.addEventListener('click', () => selectUser(user));
        user.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            selectUser(user);
        }
        });
    });

    selectUser(users[0]);
});
