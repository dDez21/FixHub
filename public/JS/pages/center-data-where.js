document.addEventListener('DOMContentLoaded', () => {
  const centers = document.querySelectorAll('.center-single');
  const cards = document.querySelectorAll('.center-detail');
  if (!centers.length) return;

  function hideAll() {
    cards.forEach(c => (c.style.display = 'none'));
  }

  function showCenterById(id) {
    hideAll();
    const card = document.getElementById(`center-data-${id}`);
    if (card) card.style.display = 'block';
  }

  centers.forEach(el => {
    el.addEventListener('click', () => {
      centers.forEach(c => c.classList.remove('is-selected'));
      el.classList.add('is-selected');
      showCenterById(el.dataset.id);
    });

    el.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') {
        e.preventDefault();
        centers.forEach(c => c.classList.remove('is-selected'));
        el.classList.add('is-selected');
        showCenterById(el.dataset.id);
      }
    });
  });

  // Mostra il primo di default
  centers[0].classList.add('is-selected');
  showCenterById(centers[0].dataset.id);
});