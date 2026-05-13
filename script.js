const navbar = document.getElementById('navbar');
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');
const dropdown = document.querySelector('.dropdown');

/* Navbar scroll effect (works on ALL pages) */
window.addEventListener('scroll', () => {
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

/* Mobile menu toggle */
if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
}

/* Mobile dropdown toggle */
if (dropdown) {
    dropdown.addEventListener('click', (e) => {
        if (window.innerWidth <= 768) {
            e.preventDefault();
            dropdown.classList.toggle('active');
            dropdown.setAttribute('aria-expanded', dropdown.classList.contains('active'));
        }
    });
}



/* HERO SECTION BEGINS HERE */

const slides = document.querySelectorAll('.slide');
const nextBtn = document.querySelector('.next');
const prevBtn = document.querySelector('.prev');

let index = 0;
let interval;

// Show slide
function showSlide(newIndex) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    slide.querySelector('.content').style.animation = 'none';
  });

  index = (newIndex + slides.length) % slides.length;

  const activeSlide = slides[index];
  activeSlide.classList.add('active');

  // Restart zoom animation
  const img = activeSlide.querySelector('img');
  img.style.animation = 'none';
  img.offsetHeight; // trigger reflow
  img.style.animation = 'zoomOut 6s linear forwards';

  // Animate text 0.8s after image
  setTimeout(() => {
    const content = activeSlide.querySelector('.content');
    content.style.animation = 'textIn 0.8s ease forwards';
  }, 800);
}

// Auto slide every 6 seconds
function startAutoSlide() {
  interval = setInterval(() => {
    showSlide(index + 1);
  }, 6000);
}

// Prev/Next buttons
nextBtn.addEventListener('click', () => {
  clearInterval(interval);
  showSlide(index + 1);
  startAutoSlide();
});

prevBtn.addEventListener('click', () => {
  clearInterval(interval);
  showSlide(index - 1);
  startAutoSlide();
});

// Init
showSlide(index);
startAutoSlide();

// About Section //
document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".slide-track");
    const slides = document.querySelectorAll(".slide-track img");

    let index = 0;
    const slideWidth = slides[0].clientWidth;

    // Clone first slide and add to end
    const firstClone = slides[0].cloneNode(true);
    track.appendChild(firstClone);

    function moveSlide() {
        index++;
        track.style.transform = `translateX(-${index * 100}%)`;

        // If we reached cloned slide
        if (index === slides.length) {
            setTimeout(() => {
                track.style.transition = "none";
                track.style.transform = `translateX(0%)`;
                index = 0;

                // Restore transition
                setTimeout(() => {
                    track.style.transition = "transform 0.8s ease-in-out";
                }, 50);

            }, 800); // match transition duration
        }
    }

    setInterval(moveSlide, 4000);
});


/*Blog section */
const blogData = [
  {
    img: "assets/img/fuudz.jpg",
    title: "Korban Fuudz",
    desc: "This is the description for blog post one.",
    text: "2026"
  },
  {
    img: "assets/img/blog1.jpeg",
    title: "Korban Drinks",
    desc: "Bringing into your day the refreshing moment. You're one step away...",
    text: "2026"
  },
  {
    img: "assets/img/blog2.jpeg",
    title: "Blog Title Three",
    desc: "Short description for blog three.",
    text: "2026"
  }
];

let current = 0;

function rotateBlogCards() {
  const bigCard = document.querySelector(".blog-big-card");
  const bigImg = document.getElementById("blogBigImage");
  const bigTitle = document.getElementById("blogBigTitle");
  const bigDesc = document.getElementById("blogBigDesc");

  // Slide Out Animation
  bigCard.classList.add("slide-out");

  setTimeout(() => {
    // Update to next card
    current = (current + 1) % blogData.length;

    bigImg.src = blogData[current].img;
    bigTitle.textContent = blogData[current].title;
    bigDesc.textContent = blogData[current].desc;
    document.getElementById("blogBigText").innerText = blogData[current].text;
    bigImg.alt = `${blogData[current].title} feature image`;

    // Reset timer bar
    const timer = document.querySelector(".blog-timer-progress");
    timer.style.animation = "none";
    timer.offsetHeight; // restart animation
    timer.style.animation = "timerFill 5s linear forwards";

    // Slide In animation
    bigCard.classList.remove("slide-out");
    bigCard.classList.add("slide-in");

    setTimeout(() => {
      bigCard.classList.remove("slide-in");
    }, 400);

    // Update small cards
    let next1 = (current + 1) % blogData.length;
    let next2 = (current + 2) % blogData.length;

    document.getElementById("blogSmallImg1").src = blogData[next1].img;
    document.getElementById("blogSmallTitle1").innerText = blogData[next1].title;
    document.getElementById("blogSmallDesc1").innerText = blogData[next1].desc;
    document.getElementById("blogSmallText1").innerText = blogData[next1].text;

    document.getElementById("blogSmallImg2").src = blogData[next2].img;
    document.getElementById("blogSmallTitle2").innerText = blogData[next2].title;
    document.getElementById("blogSmallDesc2").innerText = blogData[next2].desc;
    document.getElementById("blogSmallText2").innerText = blogData[next2].text;

  }, 0);
}

setInterval(rotateBlogCards, 5000);