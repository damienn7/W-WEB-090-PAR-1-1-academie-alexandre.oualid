// Récupération des éléments HTML

const followBtn = document.querySelector('.follow');
const followers = document.querySelectorAll('.stats')[0].querySelector('span');
const projects = document.querySelectorAll('.stats')[1].querySelector('span');
const ranks = document.querySelectorAll('.stats')[2].querySelector('span');

// Ajout d'un écouteur d'événements pour le bouton Follow

followBtn.addEventListener('click', () => {
  followBtn.classList.toggle('following');
  followBtn.textContent = followBtn.classList.contains('following') ? 'Following' : 'Follow';
});

// Mise à jour du nombre de followers, de projets et de rangs

followers.textContent = '8,797';
projects.textContent = '142';
ranks.textContent = '129';
