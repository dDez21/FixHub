document.addEventListener('DOMContentLoaded', () => {
  const regionSel = document.getElementById('region_id');
  const provSel   = document.getElementById('province_id');
  const citySel   = document.getElementById('city_id');

  if (!regionSel || !provSel || !citySel) return;

  const initialProvince = provSel.dataset.initial || '';
  const initialCity     = citySel.dataset.initial || '';

  function resetSelect(select, placeholder) {
    select.innerHTML = '';
    const opt = document.createElement('option');
    opt.value = '';
    opt.textContent = placeholder;
    select.appendChild(opt);
  }

  async function loadProvinces(regionId, selectValue = '') {
    resetSelect(provSel, 'Seleziona una provincia');
    resetSelect(citySel, 'Seleziona una città');
    if (!regionId) return;

    const res = await fetch(`/geo/regions/${regionId}/provinces`, { headers: { 'Accept':'application/json' }});
    const data = await res.json();

    data.forEach(p => {
      const opt = document.createElement('option');
      opt.value = p.id;
      opt.textContent = `${p.name} (${p.code})`;
      if (String(p.id) === String(selectValue)) opt.selected = true;
      provSel.appendChild(opt);
    });
  }

  async function loadCities(provinceId, selectValue = '') {
    resetSelect(citySel, 'Seleziona una città');
    if (!provinceId) return;

    const res = await fetch(`/geo/provinces/${provinceId}/cities`, { headers: { 'Accept':'application/json' }});
    const data = await res.json();

    data.forEach(c => {
      const opt = document.createElement('option');
      opt.value = c.id;
      opt.textContent = c.name;
      if (String(c.id) === String(selectValue)) opt.selected = true;
      citySel.appendChild(opt);
    });
  }

  regionSel.addEventListener('change', async () => {
    await loadProvinces(regionSel.value, '');
  });

  provSel.addEventListener('change', async () => {
    await loadCities(provSel.value, '');
  });

  (async () => {
    if (regionSel.value) {
      await loadProvinces(regionSel.value, initialProvince);
      if (initialProvince) {
        await loadCities(initialProvince, initialCity);
      }
    }
  })();
});