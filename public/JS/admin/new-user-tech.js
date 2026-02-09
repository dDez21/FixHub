document.addEventListener('DOMContentLoaded', () => {
  const roleSelect = document.getElementById('role');
  const techOptions = document.getElementById('tech-options');
  const categoriesOptions = document.getElementById('categories-options');

  if (!roleSelect) return;

  const techFields = techOptions ? techOptions.querySelectorAll('input, select, textarea') : [];
  const birthDate = document.getElementById('birth_date');
  const catFields = categoriesOptions ? categoriesOptions.querySelectorAll('input, select, textarea') : [];

  function update() {
    const role = roleSelect.value;
    const isTech = role === 'tech';
    const showCats = (role === 'tech' || role === 'staff');

    // solo tech
    if (techOptions) {
      techOptions.hidden = !isTech;
      techFields.forEach(f => (f.disabled = !isTech));
    }
    if (birthDate) birthDate.required = isTech;

    // categorie
    if (categoriesOptions) {
      categoriesOptions.hidden = !showCats;
      catFields.forEach(f => (f.disabled = !showCats));
    }
  }

  roleSelect.addEventListener('change', update);
  update();
});