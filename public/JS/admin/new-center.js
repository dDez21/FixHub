document.addEventListener('DOMContentLoaded', () => {
  const regionSel = document.getElementById('region_id');
  const provSel   = document.getElementById('province_id');
  const citySel   = document.getElementById('city_id');

  if (!regionSel || !provSel || !citySel) return;
  
  //recupero url geografico globale 
  const base = window.GEO_BASE || '';

  //valori iniziali di provincia e città
  const initialProvince = provSel.dataset.initial || '';
  const initialCity     = citySel.dataset.initial || '';


  //svuota tutte opzioni prov/cit quando cambio dati e metto placeholder
  function resetSelect(select, placeholder) {
      
    //metto txt placeholder nella casella
    select.innerHTML = `<option value="">${placeholder}</option>`;
  }




  //riempio select con lista elementi
  function fillSelect(select, items, selectedValue, getLabel){
      
    items.forEach(item =>{

      //creo elemento html option + gli do il valore corrispondente al suo id
      const opt = document.createElement('option');
      opt.value = item.id;

      //imposto testo visibile
      opt.textContent = getLabel(item);


      //verifico se id elemento coincide con valore dell'elemento associato
      if(String(item.id) === String(selectedValue)){
          opt.selected = true;
      }

      //aggiungo option dentro la select
      select.appendChild(opt);
    })
  }



  //la uso per fare richiesta a un URL, mi restituisce JSON
  async function getJson(url){

    //mando richiesta HTTP a URL passato chiedendo una risposta JSON
    const res = await fetch(url, { headers: { Accept : 'application/json' }});
  
    //errore nella risposta JSON
    if(!res.ok){
      throw new Error(`Errore nella richiesta: ${res.status}`);
    }
  
    //se risposta va bene
    return res.json();
  }




  //carico provincie
  async function loadProvinces(regionId, selectValue = '') {
      
    //resetto valori
    resetSelect(provSel, 'Seleziona una provincia');
    resetSelect(citySel, 'Seleziona una città');
      
    //condizione regione scelta
    if (!regionId) return;

    //chiamo funzione per ottenere provincie associate a quella regione
    const data = await getJson(`${base}/regions/${regionId}/provinces`);

    //riempio select provincie con i dati ricevuti
    fillSelect(
      profSel,
      data,
      selectValue,
      p => `${p.name}`
    )
  }




  //carico città
  async function loadCities(provinceId, selectValue = '') {
    
    resetSelect(citySel, 'Seleziona una città');
    if (!provinceId) return;

    //recupero città di quella provincia
    const data = await getJson(`${base}/provinces/${provinceId}/cities`);

    //riempio select
    fillSelect(
      citySel,
      data,
      selectedValue,
      c => c.name
    );
  }



  //cambio regione scelta
  regionSel.addEventListener('change', async () => {
    
    //aspetto caricamento provincie
    await loadProvinces(regionSel.value, '');
  });


  //cambio provincia scelta
  provSel.addEventListener('change', async () => {
    
    //aspetto caricamento città
    await loadCities(provSel.value, '');
  });



  //imposto le risposte che le funzioni async devono aspettare prima di essere eseguite
  (async () => {

    //necessito di selezionare una regione
    if (!regionSel.value) return;

    //carico province associate a regione scelta
    await loadProvinces(regionSel.value, initialProvince);
    
    //se ho provincia scelta carico città
    if (initialProvince) {
      await loadCities(initialProvince, initialCity);
    }
  })();
});