document.addEventListener('DOMContentLoaded', () =>{ //aspetto che pagina sia caricata

    const searchInput = document.getElementById('search-input') // prendo elemento di input barra di ricerca
    
    const selectedCategoryLabel = document.getElementById('selected-category-label') // prendo testo categoria scelta

    const categoryLinks = document.querySelectorAll('.single-category'); // prendo link tutte categorie

    const productCards  = document.querySelectorAll('.product-card'); // prendo tutte card prodotti da mostrare

    let activeCategoryId = ""; // prendo id categoria selezionata (se vuoto -> tutte)


    // normalizzo stringhe
    const norm = (s) => (s ?? "").toString().toLowerCase().trim();

    // accetto caratteri speciali
    const wordsOf = (s) => norm(s).split(/[^\wàèéìòù]+/i).filter(Boolean);


    const matchToken = (allText, words, t) => {
        if (!t) return true;

        // "*" 
        if (t === "*") return true;

        const starPos = t.indexOf("*");
        if (starPos === -1) {
            //
            return allText.includes(t);
        }

        // *  solo carattere finale
        if (starPos !== t.length - 1) {
            return false;
        }

        const prefix = t.slice(0, -1);
        if (prefix === "") return true;

        // parole con quel prefisso
        return words.some(w => w.startsWith(prefix));
    };


    // applico filtri
    function applyFilters(){

        // nessun risultato
        const noResultsEl = document.getElementById('no-results');
        
        
        const text = norm(searchInput?.value);
        const tokens = text ? text.split(/\s+/).filter(Boolean) : [];

        let visibleCount = 0;

        productCards.forEach(card => {

            const name = norm(card.dataset.name);
            const description = norm(card.dataset.description || card.getAttribute('data-description'));

            const all = `${name} ${description}`;
            const words = wordsOf(all);

            // filtro categoria
            const catSelected = !activeCategoryId || card.dataset.categoryId === activeCategoryId;

            // filtro testo
            const textOk = tokens.every(t => matchToken(all, words, t));

            const show = catSelected && textOk;

            card.style.display = show ? "" : "none";
            if (show) visibleCount++;
        });

        if (noResultsEl) {
            noResultsEl.style.display = (visibleCount === 0) ? "block" : "none";
        }
    }

    // filtro mentre digito
    if (searchInput) {
        searchInput.addEventListener('input', applyFilters);
    }

    // click su categoria
    categoryLinks.forEach((link) => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            activeCategoryId = link.dataset.categoryId || "";

            categoryLinks.forEach(l => l.classList.remove('selected'));
            link.classList.add('selected');

            if (selectedCategoryLabel) {
                selectedCategoryLabel.textContent = link.textContent.trim();
            }

            applyFilters();
        });
    });

    // tutte le categorie
    const allLink = document.querySelector('.single-category[data-category-id=""]');
    if (allLink) allLink.classList.add('selected');

    applyFilters();
});