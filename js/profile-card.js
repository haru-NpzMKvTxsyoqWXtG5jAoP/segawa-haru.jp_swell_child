document.addEventListener('DOMContentLoaded', function () {
  const cardContainers = document.querySelectorAll('.haru-profile-card-container');
  
  cardContainers.forEach(container => {
    container.addEventListener('click', () => {
      const card = container.querySelector('.haru-profile-card');
      if (card) {
        card.classList.toggle('is-flipped');
      }
    });
  });
}); 