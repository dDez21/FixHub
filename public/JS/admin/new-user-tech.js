document.addEventListener('DOMContentLoaded', () => {

    const roleSelect = document.getElementById('role'); //ruolo selezionato
    const techOptions = document.getElementById('tech-options'); //sezione ulteriore tecnico
    
    if (!roleSelect || !techOptions) return;

    const fields = techOptions.querySelectorAll('input, select, textarea'); //campi tecnico
    const birthDate = document.getElementById('birth_date');

    const updateTechOptions = () => {
        const isTech = roleSelect.value === 'tech';

        techOptions.hidden = !isTech;
        fields.forEach(f => { f.disabled = !isTech; });

        if (birthDate) birthDate.required = isTech; //obbligatoria solo per tech
    };

    roleSelect.addEventListener('change', updateTechOptions);
    updateTechOptions();
});