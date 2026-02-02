//inizializzo carousel
function initCarousel(carousel){

    const track = carousel.querySelector(".carousel-track"); //prendo riga che scorre
    const slides = Array.from(carousel.querySelectorAll(".carousel-slide")) //prendo tutte le immagini
    const dotsWrap = carousel.querySelector(".carousel-dots"); //contenitore pallini
    
    //prendo bottoni
    const prevBtn = carousel.querySelector(".carousel-button.prev");
    const nextBtn = carousel.querySelector(".carousel-button.next");

    const interval = Number(carousel.dataset.interval || 5000); //tempo tra ogni scorrimento

    let index = 0; //indice prima immagine
    let timer = null;

    if(!track || slides.length === 0) return //condizione che mi fa partire il carousel

    const dots = []; //creo array indicatori
    if (dotsWrap){
        dotsWrap.innerHTML = ""; //ripulisco già presenti
        
        //creo pallino per ogni immagine
        slides.forEach((_, i) => {
            const dot = document.createElement("button");
            dot.type = "button";
            dot.className = "carousel-dot"; //gli do classe per gli indicatori creata

            if(i == 0) dot.classList.add("is-active") //ho preso il primo indicatore
        
            dot.addEventListener("click", () => goTo(i)); //cambio immagine se clicco su indicatore corrispondente
            
            dotsWrap.appendChild(dot) //lo aggiungo all'elenco degli indicatori
            dots.push(dot); //lo salvo nell'array degli indicatori

        });
    }


    //aggiorno posizione track e stato indicatori
    function update(){
        track.style.transform = `translateX(-${index * 100}%)`; //sposto striscia
        dots.forEach((d, i) => d.classList.toggle("is-active", i === index));
    }


    //va all'immagine associata
    function goTo(i){
        index = (i + slides.length) % slides.length;
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
    if (nextBtn) nextBtn.addEventListener("click", next);
    if (prevBtn) prevBtn.addEventListener("click", prev);


    //autoplay
    function start(){
        stop() //parto da 0 nel timer
        timer = setInterval(next, interval);
    }


    //ferma autoplay 
    function stop(){
        if (timer) clearInterval(timer); //cancello timer
        timer = null;
    }

    update() //inizio da 0
    start() //avvia autoplay
}

//inizializzo carosello quando DOM pronto
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".carousel").forEach(initCarousel);
});
