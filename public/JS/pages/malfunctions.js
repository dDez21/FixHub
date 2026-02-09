document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.malfunction-single');

    const nameEl = document.getElementById('malfunction-name');
    const descEl = document.getElementById('malfunction-description');
    const solutionEl = document.getElementById('malfunction-solution');

    if (!items.length || !card) return;

    function showMalfunction(el) {
        const name = el.dataset.name || '';
        const desc = el.dataset.description || '';
        const solution = el.dataset.solution || '';

        if(name) nameEl.textContent = name;
        if(desc) descEl.textContent = desc;
        if(solution) solutionEl.textContent = solution ? `Soluzione: ${solution}` : '';
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
});