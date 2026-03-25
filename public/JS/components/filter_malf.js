$(document).ready(function () {

    const $malfunctions = $('#malfunctions');
    const $noResults = $('#no-results');
    const $searchInput = $('#search-input');
    const $searchButton = $('#search-button');
    const searchUrl = $('.malfunctions-list').data('search-url');

    //ripulisco testo prima di inserirlo nell'HTML, evito lettura non voluta di caratteri speciali
    function escapeHtml(text) {
        return $('<div>').text(text).html();
    }


    //creo card malf
    function buildMalfCard(malf){

        //restituisco stringa HTML
        return `
                <div class="malfunction-single" role="button" tabindex="0">
                    <p class="medium-text malfunction-item">${escapeHtml(malf.name)}</p>
                </div>
        `;
    }


    //mostro malf
    function showMalfs(malfs){

        $malfunctions.empty();

        //no malf
        if (!malfs.lenght){
            $noResults.text('La ricerca non ha prodotto risultati').show();
            return;
        }

        //nasconde messaggio "no risultati"
        $noResults.hide();


        //metto malf nella lista
        $.each(malfs, function (index, malf) {
            $malfunctions.append(buildProductCard(malf));
        });
    }


    //effettua ricerca
    function doSearch(){

        //leggo testo input
        const query = $searchInput.val().trim();

        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: {input: query},
            dataType: 'json',


            //filtraggio riuscito
            success: function (malfs) {
                showMalfs(malfs);
            },


            //fallisco
            error: function () {
                $malfunctions.empty();
                $noResults.text('Errore durante la ricerca').show();
            }
        })
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

})