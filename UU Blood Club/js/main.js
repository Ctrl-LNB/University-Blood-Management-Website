const expandBtn = document.getElementById('expand-btn');
const navMenu = document.getElementById('nav-menu');

expandBtn.addEventListener('click', (e) => {
  e.preventDefault();

  if (navMenu.style.display === 'block') {
    navMenu.style.display = 'none';
    expandBtn.classList.remove("fa-xmark");
    expandBtn.classList.add("fa-bars");
  } else {
    navMenu.style.display = 'block';
    expandBtn.classList.add("fa-xmark");
    expandBtn.classList.remove("fa-bars");
  }
});

navMenu.addEventListener('click', (e) => {
  navMenu.style.display = 'none';
  expandBtn.classList.remove("fa-xmark");
  expandBtn.classList.add("fa-bars");
});


// Blood Slider Animation
const teamImages = document.querySelectorAll('.team-slider img');
let currentTeam = 0;

console.log(teamImages);

if (teamImages.length > 0) {
  teamImages[currentTeam].classList.add('active');

  setInterval(() => {
    teamImages[currentTeam].classList.remove('active');
    currentTeam = (currentTeam + 1) % teamImages.length;
    teamImages[currentTeam].classList.add('active');
  }, 3000);
}



