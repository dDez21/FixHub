$(document).ready(function () {

    const $malfunctions = $('#malfunctions');
    const $noResults = $('#no-results');
    const $searchInput = $('#malf-input');
    const $searchButton = $('#malf-button');
    const searchUrl = $('.malfunctions-list').data('search-url');

    const $card = $('#malfunction-data');
    const $nameEl = $('#malfunction-name');
    const $descEl = $('#malfunction-description');
    const $solutionEl = $('#malfunction-solution');
    const $actions = $('#malfunction-actions');
    const $editLink = $('#malf-edit-link');
    const $deleteLink = $('#malf-delete-link');

    function escapeHtml(text) {
        return $('<div>').text(text ?? '').html();
    }

    function buildMalfCard(malf) {
        return `
            <div class="malfunction-single"
                 role="button"
                 tabindex="0"
                 data-id="${malf.id}"
                 data-name="${escapeHtml(malf.name)}"
                 data-description="${escapeHtml(malf.description)}"
                 data-solution="${escapeHtml(malf.solution)}"
                 ${malf.edit_url ? `data-edit-url="${escapeHtml(malf.edit_url)}"` : ''}
                 ${malf.delete_url ? `data-delete-url="${escapeHtml(malf.delete_url)}"` : ''}>
                <p class="medium-text malfunction-item">${escapeHtml(malf.name)}</p>
            </div>
        `;
    }

    function showSelectedMalfunction($el) {
        const name = $el.attr('data-name') || '';
        const desc = $el.attr('data-description') || '';
        const solution = $el.attr('data-solution') || '';
        const editUrl = $el.attr('data-edit-url') || '';
        const deleteUrl = $el.attr('data-delete-url') || '';

        $card.show().attr('aria-hidden', 'false');
        $nameEl.text(name);
        $descEl.text(desc);
        $solutionEl.text(solution ? `Soluzione: ${solution}` : '');

        if ($actions.length) {
            if (editUrl || deleteUrl) {
                $actions.show();

                if ($editLink.length) {
                    $editLink.attr('href', editUrl || 'javascript:void(0)');
                    $editLink.attr('aria-disabled', editUrl ? 'false' : 'true');
                }

                if ($deleteLink.length) {
                    $deleteLink.attr('href', deleteUrl || 'javascript:void(0)');
                    $deleteLink.attr('aria-disabled', deleteUrl ? 'false' : 'true');
                }
            } else {
                $actions.hide();
            }
        }
    }

    function selectMalfunction($el) {
        $malfunctions.find('.malfunction-single').removeClass('is-selected');
        $el.addClass('is-selected');
        showSelectedMalfunction($el);
    }

    function showMalfs(malfs) {
        $malfunctions.empty();

        if (!malfs.length) {
            $noResults.text('La ricerca non ha prodotto risultati').show();
            $card.hide().attr('aria-hidden', 'true');
            if ($actions.length) $actions.hide();
            return;
        }

        $noResults.hide();

        $.each(malfs, function (index, malf) {
            $malfunctions.append(buildMalfCard(malf));
        });

        const $first = $malfunctions.find('.malfunction-single').first();
        if ($first.length) {
            selectMalfunction($first);
        }
    }

    function doSearch() {
        const query = $searchInput.val().trim();

        $.ajax({
            url: searchUrl,
            type: 'GET',
            data: { input: query },
            dataType: 'json',

            success: function (malfs) {
                showMalfs(malfs);
            },

            error: function () {
                $malfunctions.empty();
                $noResults.text('Errore durante la ricerca').show();
                $card.hide().attr('aria-hidden', 'true');
                if ($actions.length) $actions.hide();
            }
        });
    }

    $searchButton.on('click', function () {
        doSearch();
    });

    $searchInput.on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            doSearch();
        }
    });

    // event delegation: funziona anche sugli elementi creati via AJAX
    $malfunctions.on('click', '.malfunction-single', function () {
        selectMalfunction($(this));
    });

    $malfunctions.on('keydown', '.malfunction-single', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            selectMalfunction($(this));
        }
    });

    // selezione iniziale del primo elemento già presente
    const $firstInitial = $malfunctions.find('.malfunction-single').first();
    if ($firstInitial.length) {
        selectMalfunction($firstInitial);
    }
});