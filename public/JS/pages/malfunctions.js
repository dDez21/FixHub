document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.malfunction-single');
    const card = document.getElementById('malfunction-data');
    const nameEl = document.getElementById('malfunction-name');
    const descEl = document.getElementById('malfunction-description');
    const solutionEl = document.getElementById('malfunction-solution');
    const actions = document.getElementById('malfunction-actions');
    const editLink = document.getElementById('malf-edit-link');
    const deleteLink = document.getElementById('malf-delete-link');

    if (!items.length || !card) return;

    //mostra malfunzionamento
    function showMalfunction(el) {
        const name = el.dataset.name || '';
        const desc = el.dataset.description || '';
        const solution = el.dataset.solution || '';


        card.style.display = 'block';
        card.setAttribute('aria-hidden', 'false');

        nameEl.textContent = name;
        descEl.textContent = desc;
        solutionEl.textContent = solution ? `Soluzione: ${solution}` : '';

        // aggiorno i link per modifica malf se presenti
        if (editLink && el.dataset.editUrl) {
            editLink.href = el.dataset.editUrl;
            editLink.setAttribute('aria-disabled', 'false');
        }

        if (deleteLink && el.dataset.deleteUrl) {
            deleteLink.href = el.dataset.deleteUrl;
            deleteLink.setAttribute('aria-disabled', 'false');
        }

        if (actions && (el.dataset.editUrl || el.dataset.deleteUrl)) {
            actions.style.display = 'flex';
        }
    }

    //seleziono malfunzionamento
    function selectMalfunction(el) {
        //tolgo a tutti selezione
        items.forEach(i => i.classList.remove('is-selected'));
        //do selezione solo a quel malfunzionamento
        el.classList.add('is-selected');
        //lo mostro
        showMalfunction(el);
    }

    //aggiungo selezione ad ogni elemento della lista
    items.forEach(el => {
        el.addEventListener('click', () => selectMalfunction(el));

        //navigazione con tastiera
        el.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                selectMalfunction(el);
                }
            });
    });

    selectMalfunction(items[0]);
});