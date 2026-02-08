document.addEventListener('DOMContentLoaded', () => {
    const users = document.querySelectorAll('.user-single');
    if (!users.length) return;

    const nameUser = document.getElementById('user-name');
    const surnameUser = document.getElementById('user-surname');
    const roleUser = document.getElementById('user-role');
    const usernameUser = document.getElementById('user-username');

    const techBox = document.getElementById('tech-data');
    const techCenter = document.getElementById('user-tech-center');
    const techCategories = document.getElementById('user-tech-categories');

    const staffBox = document.getElementById('staff-data');
    const staffCategories = document.getElementById('user-staff-categories');

    const editLink = document.getElementById('user-edit-link');
    const deleteLink = document.getElementById('user-delete-link');

    function roleLabel(role) {
        if (role === 'admin') return 'Admin';
        if (role === 'tech') return 'Tecnico';
        if (role === 'staff') return 'Staff';
        return role || '';
    }

    async function fetchJson(url) {
        if (!url) return null;
        try {
        const res = await fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
        if (!res.ok) return null;
        return await res.json();
        } catch (e) {
        console.error('Errore fetch:', e);
        return null;
        }
    }

    async function showUser(el) {
        const name = el.dataset.name || '';
        const surname = el.dataset.surname || '';
        const role = el.dataset.role || '';
        const username = el.dataset.username || '';

        if (nameUser) nameUser.textContent = name;
        if (surnameUser) surnameUser.textContent = surname;
        if (roleUser) roleUser.textContent = role ? `Ruolo: ${roleLabel(role)}` : '';
        if (usernameUser) usernameUser.textContent = `Username: ${username}`;

        // aggiorno link azioni (FIX “sempre stesso utente”)
        if (editLink) editLink.href = el.dataset.editUrl || '#';
        if (deleteLink) deleteLink.href = el.dataset.deleteUrl || '#';

        // reset box
        if (techBox) techBox.style.display = 'none';
        if (techCenter) techCenter.textContent = '';
        if (techCategories) techCategories.textContent = '';

        if (staffBox) staffBox.style.display = 'none';
        if (staffCategories) staffCategories.textContent = '';

        // TECH details
        if (role === 'tech') {
        const data = await fetchJson(el.dataset.techUrl);
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
        const data = await fetchJson(el.dataset.staffUrl);
        if (data && data.staff) {
            if (staffBox) staffBox.style.display = 'block';
            const categories = data.staff.categories || [];
            if (staffCategories) staffCategories.textContent = categories.length ? `Categorie: ${categories.join(', ')}` : 'Categorie: -';
        }
        }
    }

    function selectUser(el) {
        users.forEach(c => c.classList.remove('is-selected'));
        el.classList.add('is-selected');
        showUser(el);
    }

    users.forEach(el => {
        el.addEventListener('click', () => selectUser(el));
        el.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            selectUser(el);
        }
        });
    });

    selectUser(users[0]);
});
