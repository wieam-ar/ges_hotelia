const carousel = new bootstrap.Carousel(
  document.getElementById("hotelCarousel"),
  {
    interval: 80000,
    wrap: true,
    touch: true,
  }
);

// Add hover effects
document.querySelectorAll(".hotel-card").forEach((card) => {
  card.addEventListener("mouseenter", function () {
    this.style.transform = "translateY(-5px) scale(1.02)";
  });

  card.addEventListener("mouseleave", function () {
    this.style.transform = "translateY(0) scale(1)";
  });
});

// Add floating animation to decorative circles
const circles = document.querySelectorAll(".circle");
circles.forEach((circle, index) => {
  circle.style.animation = `float ${
    3 + index * 0.5
  }s ease-in-out infinite alternate`;
});

// Add CSS animation keyframes
const style = document.createElement("style");
style.textContent = `
            @keyframes float {
                0% { transform: translateY(0px); }
                100% { transform: translateY(-10px); }
            }
        `;
document.head.appendChild(style);


