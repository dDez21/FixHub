//inizializzo carousel, uso jQuery
function initCarousel($carousel){ //$carousel è l'elemento jQuery del carosello

    const $track = $carousel.find(".carousel-track"); //prendo riga che scorre
    const $images = $carousel.find(".carousel-slide"); //prendo tutte le immagini
    

    //prendo bottoni
    const $prevBtn = $carousel.find('.carousel-button.prev');
    const $nextBtn = $carousel.find('.carousel-button.next');

    const interval = 5000; //intervallo di tempo tra ogni scorrimento

    let index = 0; //indice prima immagine
    let timer = null; //timer per scorrimento

    //condizione che mi fa partire il carousel, evita che parta se non ho preso correttamente le foto
    if($track.length === 0 || $images.length === 0) return 


    //aggiorno posizione carosello
    function update(){
        $track.css("transform", `translateX(-${index * 100}%)`); //css mi permette di modificare proprietà CSS elemento
    }


    //va all'immagine associata
    function goTo(i){
        index = (i + $images.length) % $images.length;
        update(); //applico cambio
    }


    //prossima immagine
    function next() {
        goTo(index + 1);
    }


    //immagine precedente
    function prev() {
        goTo(index - 1);
    }


    //collegamento bottoni
    if ($nextBtn.length) $nextBtn.on("click", next);
    if ($prevBtn.length) $prevBtn.on("click", prev);


    //autoplay
    function start(){
        stop() //chiamato prima per evitare di creare un altro timer
        timer = setInterval(next, interval);  //richiama next() ogni tot tempo dato da interval
    }


    //ferma autoplay 
    function stop(){
        if (timer) clearInterval(timer); //cancello timer
        timer = null; //reimposto timer a null
    }

    update(); //inizio da 0
    start(); //avvia autoplay
}

console.log("carousel js caricato");

//inizializzo carosello quando DOM pronto
$(document).ready(function(){

    //eseguo il codice per ogni immagine nel carosello
    $(".carousel").each(function(){
        initCarousel($(this));
    });
});