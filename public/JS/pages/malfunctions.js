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

    
    function setDisabled(link, disabled) {
        if (!link) return;
        if (disabled) {
        link.setAttribute('aria-disabled', 'true');
        link.href = 'javascript:void(0)';
        } else {
        link.removeAttribute('aria-disabled');
        }
    }

    setDisabled(editLink, true);
    setDisabled(deleteLink, true);
    if (actions) actions.style.display = 'none';

    function showMalfunction(el) {

        nameEl.textContent = '';
        descEl.textContent = '';
        solutionEl.textContent = '';

        const name = el.dataset.name || '';
        const desc = el.dataset.description || '';
        const solution = el.dataset.solution || '';

        nameEl.textContent = name;
        descEl.textContent = desc;
        solutionEl.textContent = solution ? `Soluzione: ${solution}` : '';

        card.style.display = 'block';
        card.setAttribute('aria-hidden', 'false');

        // staff: set href e mostra bottoni
        const editUrl = el.dataset.editUrl;
        const deleteUrl = el.dataset.deleteUrl;

        if (editLink && editUrl) {
        editLink.href = editUrl;
        setDisabled(editLink, false);
        } else {
        setDisabled(editLink, true);
        }

        if (deleteLink && deleteUrl) {
        deleteLink.href = deleteUrl;
        setDisabled(deleteLink, false);
        } else {
        setDisabled(deleteLink, true);
        }

        if (actions) {
        actions.style.display = (editUrl || deleteUrl) ? 'flex' : 'none';
        }
    }

    function selectMalfunction(el) {
        items.forEach(i => i.classList.remove('is-selected'));
        el.classList.add('is-selected');
        showMalfunction(el);
    }

    
    items.forEach(el => {
        el.addEventListener('click', () => selectMalfunction(el));
        el.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            selectMalfunction(el);
        }
        });
    });
    selectMalfunction(items[0]);
});