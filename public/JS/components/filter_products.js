$(document).ready(function () {

    const $grid = $('#products-grid');
    const $noResults = $('#no-results');
    const $searchInput = $('#search-input');
    const $searchButton = $('#search-button');
    const $categoryLinks = $('.single-category');
    const $selectedCategoryLabel = $('#selected-category-label');
    const searchUrl = $('.products-layout').data('search-url');

    let activeCategoryId = '';

    // evidenzio "Tutte le categorie" se esiste
    const $allCategoriesLink = $('.single-category[data-category-id=""]');
    if ($allCategoriesLink.length) {
        $allCategoriesLink.addClass('selected');
    }


    //ripulisco testo prima di inserirlo nell'HTML, evito lettura non voluta di caratteri speciali
    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }


    //creo card prodotto
    function buildProductCard(product) {
        
        //restituisco stringa HTML
        return `
            <div class="card product-card">
                <div class="product-icon">
                    <img src="${product.image_url}" alt="${escapeHtml(product.name)}">
                </div>
                <div class="product-info">
                    <a class="product-name-ref" href="${product.show_url}">
                        ${escapeHtml(product.name)}
                    </a>
                </div>
            </div>
        `;
    }


    //mostra i prodotti ricevuti nella griglia
    function showProducts(products) {
        
        //svuoto griglia
        $grid.empty();

        //no prodotti
        if (!products.length) {
            $noResults.text('La ricerca non ha prodotto risultati').show();
            return;
        }

        //nasconde messaggio "no risultati"
        $noResults.hide();


        //inserisce nella griglia ogni prodotto della ricerca
        $.each(products, function (index, product) {
            $grid.append(buildProductCard(product));
        });
    }

    
    //esegue ricerca
    function doSearch() {

        //leggo testo input
        let query = $searchInput.val().trim();

        // input vuoto o solo * = nessun filtro testuale
        if (query === '*' || query === '') {
            query = '';
        }


        //chiamata AJAX, cioè mando richiesta a server
        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: {
                input: query,
                category_id: activeCategoryId
            },
            dataType: 'json',


            //filtraggio riuscito
            success: function (products) {
                showProducts(products);
            },


            //fallisco
            error: function () {
                $grid.empty();
                $noResults.text('Errore durante la ricerca').show();
            }
        });
    }


    // click bottone ricerca
    $searchButton.on('click', function () {
        doSearch();
    });

    // invio con tasto Enter
    $searchInput.on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            doSearch();
        }
    });

    // click categoria
    $categoryLinks.on('click', function (select) {
        select.preventDefault();

        activeCategoryId = $(this).data('category-id');

        if (activeCategoryId === undefined || activeCategoryId === null) {
            activeCategoryId = '';
        }

        $categoryLinks.removeClass('selected');
        $(this).addClass('selected');

        $selectedCategoryLabel.text($(this).text().trim());

        doSearch();
    });

});