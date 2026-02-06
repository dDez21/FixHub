document.addEventListener('DOMContentLoaded', () =>{ //aspetto che pagina sia caricata

    const searchInput = document.getElementById('search-input') // prendo elemento di input barra di ricerca
    
    const selectedCategoryLabel = document.getElementById('selected-category-label') // prendo testo categoria scelta

    const categoryLinks = document.querySelectorAll('.single-category'); // prendo link tutte categorie

    const productCards  = document.querySelectorAll('.product-card'); // prendo tutte card prodotti da mostrare

    let activeCategoryId = ""; // prendo id categoria selezionata (se vuoto -> tutte)


    // normalizzo stringhe
    const norm = (s) => (s ?? "").toString().toLowerCase().trim();


    // applico filtri
    function applyFilters(){

        // nessun risultato
        const noResultsEl = document.getElementById('no-results');
        
        // prendo testo barra di ricerca
        const text = norm(searchInput?.value);
        const token = text ? text.split(/\s+/) : [];

        let visibleCount = 0;
        
        // passo ogni singola card prodotto
        productCards.forEach(card => { 
            
            // prendo nome e descrizione e le normalizzo
            const name = norm(card.dataset.name);
            const description = norm(card.dataset.description || card.getAttribute('data-description'));

            // creo unica stringa
            const all = `${name} ${description}`;

            // filtro per categoria
            const catSelected = !activeCategoryId || card.dataset.categoryId === activeCategoryId;

            // cerco tutte le parole del testo inserito
            const textInsert = token.every(t => all.includes(t))

            const show = catSelected && textInsert

            card.style.display = show ? "" : "none";
            if (show) visibleCount++;
        })
    
        // nessun risultato
        if (noResultsEl){
            noResultsEl.style.display = (visibleCount === 0) ? "block" : "none";
        }
    }

    


    // filtro applicato mentre digito
    if (searchInput){
        searchInput.addEventListener('input', applyFilters)
    }


    // creo collegamento per ogni categoria
    categoryLinks.forEach((link) => {
        
        link.addEventListener('click', (e) => {
            
            // evito di ritornare in alto o ricaricare la pagina al click
            e.preventDefault();

            //imposto la categoria attiva
            activeCategoryId = link.dataset.categoryId || "";

            // rimuovo selected ad altre categorie e lo metto a categoria scelta
            categoryLinks.forEach(l => l.classList.remove('selected'));
            link.classList.add('selected');

            // aggiorno testo della categoria scelta
            if (selectedCategoryLabel) {
                selectedCategoryLabel.textContent = link.textContent.trim();
            }

            //applico filtri
            applyFilters();
        })
    })

    //seleziono tutte le categorie di default
    const allLink = document.querySelector('.single-category[data-category-id=""]');
    if (allLink) allLink.classList.add('selected');
    
    applyFilters();
})