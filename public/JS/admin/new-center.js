document.addEventListener('DOMContentLoaded', () => {
  const regionSel = document.getElementById('region_id');
  const provSel   = document.getElementById('province_id');
  const citySel   = document.getElementById('city_id');

  if (!regionSel || !provSel || !citySel) return;
  
  const base = window.GEO_BASE || '';

  //valori iniziali provincia e città
  const initialProvince = provSel.dataset.initial || '';
  const initialCity     = citySel.dataset.initial || '';

  //svuota tutte opzioni prov/cit quando cambio dati e metto placeholder
  function resetSelect(select, placeholder) {
    
    //svuota tutte le opzioni
    select.innerHTML = '';

    //creo nuova opzione placeholder
    const opt = document.createElement('option');
    opt.value = '';
    opt.textContent = placeholder;

    //inserisco opzione
    select.appendChild(opt);
  }

  //carico provincie
  async function loadProvinces(regionId, selectValue = '') {
    
    //resetto valori
    resetSelect(provSel, 'Seleziona una provincia');
    resetSelect(citySel, 'Seleziona una città');
    
    //condizione regione scelta
    if (!regionId) return;

    //creo url dinamico per prendere le provincie
    //await mi fa attendere che arrivi la risposta
    const res = await fetch(`${base}/regions/${regionId}/provinces`, { headers:{Accept:'application/json'} });    
    
    //converto in json ottenendo un array di provincie
    const data = await res.json();

    //do opzione ad ogni provincia
    data.forEach(p => {
        const opt = document.createElement('option');
        opt.value = p.id;
        opt.textContent = opt.textContent = p.code ? p.code : p.name;
        
        //se ho già provincia selezionata
        if (String(p.id) === String(selectValue)) opt.selected = true;
        
        //aggiungo opzione al DOM
        provSel.appendChild(opt);
    });
  }

  //carico città
  async function loadCities(provinceId, selectValue = '') {
    resetSelect(citySel, 'Seleziona una città');
    if (!provinceId) return;

    const res = await fetch(`${base}/provinces/${provinceId}/cities`, { headers:{Accept:'application/json'} });
    const data = await res.json();

    data.forEach(c => {
      const opt = document.createElement('option');
      opt.value = c.id;
      opt.textContent = c.name;
      if (String(c.id) === String(selectValue)) opt.selected = true;
      citySel.appendChild(opt);
    });
  }

  //cambio regione scelta
  regionSel.addEventListener('change', async () => {
    await loadProvinces(regionSel.value, '');
  });

  //cambio provincia scelta
  provSel.addEventListener('change', async () => {
    await loadCities(provSel.value, '');
  });

  //imposto le risposte che le funzioni async devono aspettare prima di essere eseguite
  (async () => {
    if (regionSel.value) {
      await loadProvinces(regionSel.value, initialProvince);
      if (initialProvince) {
        await loadCities(initialProvince, initialCity);
      }
    }
  })();
});