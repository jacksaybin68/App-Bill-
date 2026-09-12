// ----------------------------------------
// Nothing special but still something :)
// Hope you like it <3
// ----------------------------------------

const fireworksData = [
    //
    // T = 0 ms (Big opener - multiple launches)
    //
    {
        left: '15%',
        color: '#FF4C4C', // Bright Red
        explosionType: 'circle',
        size: 'large',
        launchTime: 0,
    },
    {
        left: '70%',
        color: '#FFD24C', // Bright Gold
        explosionType: 'star',
        size: 'medium',
        launchTime: 0,
    },

    //
    // T = 3,000 ms
    //
    {
        left: '30%',
        color: '#5ECFFF', // Vibrant Light Blue
        explosionType: 'double-spiral',
        size: 'small',
        launchTime: 3000,
    },
    {
        left: '80%',
        color: '#7DFF5E', // Bright Green
        explosionType: 'wave',
        size: 'large',
        launchTime: 3000,
    },

    //
    // T = 6,000 ms (Triple launch)
    //
    {
        left: '25%',
        color: '#C15EFF', // Vivid Purple
        explosionType: 'heart',
        size: 'medium',
        launchTime: 6000,
    },
    {
        left: '50%',
        color: '#FF4CF6', // Magenta
        explosionType: 'swirl',
        size: 'medium',
        launchTime: 6000,
    },
    {
        left: '75%',
        color: '#FFF44C', // Bright Yellow
        explosionType: 'heart',
        size: 'small',
        launchTime: 6000,
    },

    //
    // T = 10,000 ms
    //
    {
        left: '20%',
        color: '#FF964C', // Vivid Orange
        explosionType: 'flower',
        size: 'large',
        launchTime: 10000,
    },
    {
        left: '70%',
        color: '#4CFFB7', // Neon Mint
        explosionType: 'random-burst',
        size: 'small',
        launchTime: 10000,
    },

    //
    // T = 13,000 ms (Triple launch)
    //
    {
        left: '40%',
        color: '#4CDAFF', // Bright Sky Blue
        explosionType: 'random-burst',
        size: 'medium',
        launchTime: 13000,
    },
    {
        left: '60%',
        color: '#F64CFF', // Hot Pink
        explosionType: 'spiral',
        size: 'large',
        launchTime: 13000,
    },
    {
        left: '85%',
        color: '#FF4C7D', // Hot Pinkish Red
        explosionType: 'star',
        size: 'small',
        launchTime: 13000,
    },

    //
    // T = 16,000 ms (Triple launch)
    //
    {
        left: '15%',
        color: '#4CFF4C', // Neon Green
        explosionType: 'triple-star',
        size: 'large',
        launchTime: 16000,
    },
    {
        left: '30%',
        color: '#A14CFF', // Neon Purple
        explosionType: 'random-burst',
        size: 'medium',
        launchTime: 16000,
    },
    {
        left: '80%',
        color: '#FFB74C', // Light Orange
        explosionType: 'circle',
        size: 'small',
        launchTime: 16000,
    },

    //
    // T = 20,000 ms (Triple launch)
    //
    {
        left: '25%',
        color: '#FF4C4C', // Bright Red
        explosionType: 'flower',
        size: 'small',
        launchTime: 20000,
    },
    {
        left: '50%',
        color: '#FFD24C', // Bright Gold
        explosionType: 'heart',
        size: 'medium',
        launchTime: 20000,
    },
    {
        left: '75%',
        color: '#5ECFFF', // Vibrant Light Blue
        explosionType: 'ring-of-rings',
        size: 'large',
        launchTime: 20000,
    },

    //
    // T = 23,000 ms (Triple launch)
    //
    {
        left: '10%',
        color: '#7DFF5E', // Bright Green
        explosionType: 'random-burst',
        size: 'small',
        launchTime: 23000,
    },
    {
        left: '40%',
        color: '#C15EFF', // Vivid Purple
        explosionType: 'spiral',
        size: 'medium',
        launchTime: 23000,
    },
    {
        left: '90%',
        color: '#FF4CF6', // Magenta
        explosionType: 'swirl',
        size: 'large',
        launchTime: 23000,
    },

    //
    // T = 26,000 ms
    //
    {
        left: '20%',
        color: '#FFF44C', // Bright Yellow
        explosionType: 'flurry',
        size: 'large',
        launchTime: 26000,
    },
    {
        left: '75%',
        color: '#FF964C', // Vivid Orange
        explosionType: 'random-burst',
        size: 'medium',
        launchTime: 26000,
    },

    //
    // T = 30,000 ms (Triple launch)
    //
    {
        left: '15%',
        color: '#4CFFB7', // Neon Mint
        explosionType: 'wave',
        size: 'small',
        launchTime: 30000,
    },
    {
        left: '60%',
        color: '#4CDAFF', // Bright Sky Blue
        explosionType: 'triple-star',
        size: 'large',
        launchTime: 30000,
    },
    {
        left: '80%',
        color: '#F64CFF', // Hot Pink
        explosionType: 'heart',
        size: 'medium',
        launchTime: 30000,
    },

    //
    // T = 33,000 ms (Triple launch)
    //
    {
        left: '25%',
        color: '#FF4C7D', // Hot Pinkish Red
        explosionType: 'random-burst',
        size: 'medium',
        launchTime: 33000,
    },
    {
        left: '50%',
        color: '#4CFF4C', // Neon Green
        explosionType: 'star',
        size: 'small',
        launchTime: 33000,
    },
    {
        left: '70%',
        color: '#A14CFF', // Neon Purple
        explosionType: 'double-spiral',
        size: 'large',
        launchTime: 33000,
    },

    //
    // T = 37,000 ms (Triple launch)
    //
    {
        left: '15%',
        color: '#FFB74C', // Light Orange
        explosionType: 'flower',
        size: 'medium',
        launchTime: 37000,
    },
    {
        left: '40%',
        color: '#FF4C4C', // Bright Red
        explosionType: 'random-burst',
        size: 'small',
        launchTime: 37000,
    },
    {
        left: '85%',
        color: '#FFD24C', // Bright Gold
        explosionType: 'heart',
        size: 'large',
        launchTime: 37000,
    },

    //
    // T = 40,000 ms (Triple launch)
    //
    {
        left: '10%',
        color: '#5ECFFF', // Vibrant Light Blue
        explosionType: 'ring-of-rings',
        size: 'medium',
        launchTime: 40000,
    },
    {
        left: '45%',
        color: '#7DFF5E', // Bright Green
        explosionType: 'wave',
        size: 'small',
        launchTime: 40000,
    },
    {
        left: '80%',
        color: '#C15EFF', // Vivid Purple
        explosionType: 'spiral',
        size: 'large',
        launchTime: 40000,
    },

    //
    // T = 43,000 ms
    //
    {
        left: '20%',
        color: '#FF4CF6', // Magenta
        explosionType: 'swirl',
        size: 'medium',
        launchTime: 43000,
    },
    {
        left: '75%',
        color: '#FFF44C', // Bright Yellow
        explosionType: 'flurry',
        size: 'large',
        launchTime: 43000,
    },

    //
    // T = 47,000 ms (Triple launch)
    //
    {
        left: '30%',
        color: '#FF964C', // Vivid Orange
        explosionType: 'double-spiral',
        size: 'large',
        launchTime: 47000,
    },
    {
        left: '70%',
        color: '#4CFFB7', // Neon Mint
        explosionType: 'wave',
        size: 'medium',
        launchTime: 47000,
    },
    {
        left: '50%',
        color: '#4CDAFF', // Bright Sky Blue
        explosionType: 'triple-star',
        size: 'small',
        launchTime: 47000,
    },

    //
    // T = 50,000 ms (Triple launch)
    //
    {
        left: '25%',
        color: '#F64CFF', // Hot Pink
        explosionType: 'heart',
        size: 'medium',
        launchTime: 50000,
    },
    {
        left: '60%',
        color: '#FF4C7D', // Hot Pinkish Red
        explosionType: 'random-burst',
        size: 'large',
        launchTime: 50000,
    },
    {
        left: '85%',
        color: '#4CFF4C', // Neon Green
        explosionType: 'random-burst',
        size: 'small',
        launchTime: 50000,
    },

    //
    // T = 53,000 ms
    //
    {
        left: '10%',
        color: '#A14CFF', // Neon Purple
        explosionType: 'ring-of-rings',
        size: 'large',
        launchTime: 53000,
    },
    {
        left: '40%',
        color: '#FFB74C', // Light Orange
        explosionType: 'circle',
        size: 'small',
        launchTime: 53000,
    },

    //
    // T = 56,000 ms
    //
    {
        left: '15%',
        color: '#FF4C4C', // Bright Red
        explosionType: 'spiral',
        size: 'small',
        launchTime: 56000,
    },
    {
        left: '75%',
        color: '#FFD24C', // Bright Gold
        explosionType: 'flurry',
        size: 'medium',
        launchTime: 56000,
    },

    //
    // T = 59,000 ms (Triple launch)
    //
    {
        left: '20%',
        color: '#5ECFFF', // Vibrant Light Blue
        explosionType: 'triple-star',
        size: 'medium',
        launchTime: 59000,
    },
    {
        left: '50%',
        color: '#7DFF5E', // Bright Green
        explosionType: 'wave',
        size: 'large',
        launchTime: 59000,
    },
    {
        left: '80%',
        color: '#C15EFF', // Vivid Purple
        explosionType: 'double-spiral',
        size: 'small',
        launchTime: 59000,
    },

    //
    // T = 62,000 ms (Grand Finale: a huge barrage of large effects!)
    //
    {
        left: '10%',
        color: '#FF4CF6', // Magenta
        explosionType: 'random-burst',
        size: 'large',
        launchTime: 62000,
    },
    {
        left: '25%',
        color: '#FFF44C', // Bright Yellow
        explosionType: 'ring-of-rings',
        size: 'large',
        launchTime: 62000,
    },
    {
        left: '40%',
        color: '#FF964C', // Vivid Orange
        explosionType: 'triple-star',
        size: 'large',
        launchTime: 62000,
    },
    {
        left: '55%',
        color: '#4CFFB7', // Neon Mint
        explosionType: 'heart',
        size: 'large',
        launchTime: 62000,
    },
    {
        left: '70%',
        color: '#4CDAFF', // Bright Sky Blue
        explosionType: 'double-spiral',
        size: 'large',
        launchTime: 62000,
    },
    {
        left: '85%',
        color: '#F64CFF', // Hot Pink
        explosionType: 'star',
        size: 'large',
        launchTime: 62000,
    },
    {
        left: '95%',
        color: '#FF4C7D', // Hot Pinkish Red
        explosionType: 'flurry',
        size: 'large',
        launchTime: 62000,
    },
    // add more if you want
];

// -------------------------
// MAIN LOGIC
// -------------------------
document.addEventListener('DOMContentLoaded', function() {
  // Create container
  const container = document.createElement('div');
  container.id = 'fireworks-container';
  document.body.appendChild(container);

  // Launch each firework at its scheduled time
  fireworksData.forEach((data) => {
    setTimeout(() => {
      launchRocket(container, data);
    }, data.launchTime);
  });

  // Calculate the maximum launch time + schedule grand finale
  const maxLaunchTime = Math.max(...fireworksData.map((d) => d.launchTime));
  const finaleTime = maxLaunchTime + 4000; // 4s after last rocket

  setTimeout(() => {
    launchGrandFinaleRocket(container);
  }, finaleTime);
});

// -------------------------
// 3) Normal Rocket + Explosion
// -------------------------
function launchRocket(container, { left, color, explosionType, size }) {
  // Create rocket element
  const rocketEl = document.createElement('div');
  rocketEl.className = 'firework-rocket';
  rocketEl.style.left = left;

  const rocketInner = document.createElement('div');
  rocketInner.className = 'firework-rocket-inner';
  rocketInner.style.backgroundColor = color;
  rocketEl.appendChild(rocketInner);
  container.appendChild(rocketEl);

  // Random apex between 40vh and 80vh
  const apex = 40 + Math.random() * 40;
  // Random travel time between 1500 and 2000 ms
  const travelTime = 1500 + Math.random() * 500;

  // Animate rocket going up
  rocketEl.animate(
    [
      { transform: 'translate(-50%, 0)' },
      { transform: `translate(-50%, -${apex}vh)` },
    ],
    {
      duration: travelTime,
      easing: 'ease-out',
      fill: 'forwards',
    }
  );

  // Create rocket sparks in an interval
  const trailInterval = setInterval(() => {
    createSpark(container, rocketEl, color);
  }, 60);

  // Explode after reaching apex
  setTimeout(() => {
    clearInterval(trailInterval);
    explode(container, rocketEl, color, explosionType, size);
  }, travelTime);
}

function explode(container, rocketEl, color, explosionType, size) {
  // Get rocket position
  const rect = rocketEl.getBoundingClientRect();
  const centerX = rect.left + rect.width / 2;
  const centerY = rect.top + rect.height / 2;
  rocketEl.remove();

  // Determine how many fragments
  let fragmentCount;
  if (size === 'small') fragmentCount = 30;
  else if (size === 'large') fragmentCount = 80;
  else fragmentCount = 50;

  // Get pattern
  const pattern = getExplosionPattern(explosionType);

  // Create explosion fragments
  for (let i = 0; i < fragmentCount; i++) {
    const angle = pattern.angles && pattern.angles.length
      ? pattern.angles[i % pattern.angles.length]
      : Math.random() * 2 * Math.PI;

    const magnitude = pattern.magnitude && pattern.magnitude.length
      ? pattern.magnitude[i % pattern.magnitude.length]
      : 1;

    createFragment(container, centerX, centerY, color, angle, size, magnitude);
  }
}

function createFragment(container, x, y, color, angle, size, magnitude) {
  const fragment = document.createElement('div');
  fragment.className = 'firework-fragment';
  fragment.style.backgroundColor = color;
  fragment.style.left = `${x}px`;
  fragment.style.top = `${y}px`;
  container.appendChild(fragment);

  // Speed based on size
  const baseVelocity = size === 'small' ? 2 : size === 'large' ? 4 : 3;
  const velocity = baseVelocity * magnitude;
  const offsetX = Math.cos(angle) * velocity * 100;
  const offsetY = Math.sin(angle) * velocity * 100;
  const duration = 2000 + Math.random() * 800;

  fragment.animate(
    [
      { transform: 'translate(0,0) scale(1)', opacity: 1 },
      { transform: `translate(${offsetX}px, ${offsetY}px) scale(0.3)`, opacity: 0 },
    ],
    {
      duration,
      easing: 'ease-out',
      fill: 'forwards',
    }
  );

  setTimeout(() => {
    fragment.remove();
  }, duration + 100);
}

// --------------------------------------------
// 4) Explosion Patterns (including 15 new ones)
// --------------------------------------------
function getExplosionPattern(type) {
  // Original "circle" pattern
  if (type === 'circle') {
    const angles = Array.from({ length: 30 }, (_, i) => (i / 30) * 2 * Math.PI);
    return { angles };
  }

  // Original "star" pattern
  if (type === 'star') {
    const angles = [];
    for (let i = 0; i < 15; i++) {
      angles.push((i / 15) * 2 * Math.PI);
      angles.push(((i + 0.2) / 15) * 2 * Math.PI);
    }
    return { angles };
  }

  // -------------------------------------------------------------------
  // 15 NEW PATTERNS:
  // -------------------------------------------------------------------
  if (type === 'double-spiral') {
    const angles = [];
    for (let i = 0; i < 40; i++) {
      angles.push((i / 10) * Math.PI);
    }
    const magnitude = angles.map((val, idx) => (idx % 2 === 0 ? 1 : 2));
    return { angles, magnitude };
  }

  if (type === 'cross') {
    const baseAngles = [0, Math.PI / 2, Math.PI, (3 * Math.PI) / 2];
    const repeated = [];
    const repeats = 10;
    for (let r = 0; r < repeats; r++) {
      repeated.push(...baseAngles);
    }
    return { angles: repeated };
  }

  if (type === 'swirl') {
    const angles = [];
    for (let i = 0; i < 60; i++) {
      angles.push(i * 0.2);
    }
    const magnitude = angles.map((_, i) => 0.5 + i * 0.05);
    return { angles, magnitude };
  }

  if (type === 'flower') {
    const angles = [];
    const magnitude = [];
    for (let i = 0; i < 36; i++) {
      angles.push((2 * Math.PI * i) / 36);
      magnitude.push(i % 2 === 0 ? 1.2 : 0.7);
    }
    return { angles, magnitude };
  }

  if (type === 'heart') {
    const angles = [];
    for (let i = 0; i < 50; i++) {
      // parametric approximation for a heart shape
      const t = (i / 25) * Math.PI;
      angles.push(t);
    }
    const magnitude = angles.map(() => 1 + Math.random() * 1);
    return { angles, magnitude };
  }

  if (type === 'ring-of-rings') {
    const angles = [];
    const magnitude = [];
    for (let ring = 1; ring <= 3; ring++) {
      for (let i = 0; i < 20; i++) {
        angles.push((2 * Math.PI * i) / 20);
        magnitude.push(ring);
      }
    }
    return { angles, magnitude };
  }

  if (type === 'diamond') {
    const baseAngles = [
      Math.PI / 4,
      (3 * Math.PI) / 4,
      (5 * Math.PI) / 4,
      (7 * Math.PI) / 4,
    ];
    const angles = [];
    for (let i = 0; i < 10; i++) {
      angles.push(...baseAngles);
    }
    return { angles };
  }

  if (type === 'hexagon') {
    const angles = [];
    const baseAngles = [
      0,
      Math.PI / 3,
      (2 * Math.PI) / 3,
      Math.PI,
      (4 * Math.PI) / 3,
      (5 * Math.PI) / 3,
    ];
    for (let i = 0; i < 10; i++) {
      angles.push(...baseAngles);
    }
    return { angles };
  }

  if (type === 'spiral') {
    const angles = [];
    for (let i = 0; i < 50; i++) {
      angles.push(i * 0.3);
    }
    const magnitude = angles.map((_, i) => 0.4 + i * 0.1);
    return { angles, magnitude };
  }

  if (type === 'flurry') {
    const angles = Array.from({ length: 60 }, () => Math.random() * 2 * Math.PI);
    const magnitude = angles.map(() => 0.5 + Math.random() * 1.5);
    return { angles, magnitude };
  }

  if (type === 'triple-star') {
    const angles = [];
    for (let s = 0; s < 3; s++) {
      for (let i = 0; i < 15; i++) {
        angles.push((i / 15) * 2 * Math.PI);
        angles.push(((i + 0.2) / 15) * 2 * Math.PI);
      }
    }
    return { angles };
  }

  if (type === 'random-burst') {
    const angles = Array.from({ length: 50 }, () => Math.random() * 2 * Math.PI);
    const magnitude = Array.from({ length: 50 }, () => 0.5 + Math.random() * 2);
    return { angles, magnitude };
  }

  if (type === 'wave') {
    const angles = [];
    const magnitude = [];
    for (let i = 0; i < 40; i++) {
      const a = (i / 40) * 2 * Math.PI;
      angles.push(a);
      magnitude.push(1 + Math.sin(a * 4));
    }
    return { angles, magnitude };
  }

  // Default random scatter if none is recognized
  const angles = Array.from({ length: 30 }, () => Math.random() * 2 * Math.PI);
  const magnitude = Array.from({ length: 30 }, () => 0.5 + Math.random() * 1.5);
  return { angles, magnitude };
}

// -------------------------
// 5) Finale Rocket + Explosion
// -------------------------
function launchGrandFinaleRocket(container) {
  const left = '50%';
  const color = '#FFFFFF';

  const rocketEl = document.createElement('div');
  rocketEl.className = 'firework-rocket';
  rocketEl.style.left = left;

  const rocketInner = document.createElement('div');
  rocketInner.className = 'firework-rocket-inner';
  rocketInner.style.backgroundColor = color;
  rocketEl.appendChild(rocketInner);
  container.appendChild(rocketEl);

  // Slight arc
  const driftX = (Math.random() - 0.5) * 40;
  const travelTime = 2200;
  rocketEl.animate(
    [
      { offset: 0,   transform: 'translate(-50%, 0)' },
      { offset: 0.3, transform: `translate(calc(-50% + ${driftX / 2}px), -20vh)` },
      { offset: 0.6, transform: `translate(calc(-50% + ${driftX}px), -45vh)` },
      { offset: 1,   transform: 'translate(-50%, -70vh)' },
    ],
    {
      duration: travelTime,
      easing: 'cubic-bezier(0.25, 0.45, 0.45, 0.95)',
      fill: 'forwards',
    }
  );

  const trailInterval = setInterval(() => {
    createSpark(container, rocketEl, color);
  }, 60);

  setTimeout(() => {
    clearInterval(trailInterval);
    bigSlowExplosion(container, rocketEl);
  }, travelTime);
}

function createSpark(container, rocketEl, color) {
  const rect = rocketEl.getBoundingClientRect();
  const centerX = rect.left + rect.width / 2;
  const centerY = rect.top + rect.height / 2;

  const spark = document.createElement('div');
  spark.className = 'firework-spark';
  spark.style.backgroundColor = color;
  spark.style.left = `${centerX}px`;
  spark.style.top = `${centerY}px`;
  container.appendChild(spark);

  spark.animate(
    [
      { transform: 'translate(0,0)', opacity: 1 },
      { transform: 'translate(0, 15px)', opacity: 0 },
    ],
    {
      duration: 500,
      easing: 'ease-out',
      fill: 'forwards',
    }
  );

  setTimeout(() => {
    spark.remove();
  }, 600);
}

// -------------------------
// 6) "Slow" & Long Finale Boom
// -------------------------
function bigSlowExplosion(container, rocketEl) {
  const rect = rocketEl.getBoundingClientRect();
  const centerX = rect.left + rect.width / 2;
  const centerY = rect.top + rect.height / 2;
  rocketEl.remove();

  // Increase fragment count + bigger radius
  const fragmentCount = 500;

  for (let i = 0; i < fragmentCount; i++) {
    const angle = Math.random() * 2 * Math.PI;
    // Large radius: 300 - 700
    const radius = 300 + Math.random() * 400;
    // Big downward drift: 700 - 1200
    const rainDistance = 700 + Math.random() * 500;

    const targetX = Math.cos(angle) * radius;
    const targetY = Math.sin(angle) * radius;

    const fragment = document.createElement('div');
    fragment.className = 'firework-fragment';
    fragment.style.backgroundColor = '#FFFFFF';
    fragment.style.left = `${centerX}px`;
    fragment.style.top = `${centerY}px`;
    fragment.style.width = '3px';
    fragment.style.height = '3px';
    fragment.style.borderRadius = '50%';
    container.appendChild(fragment);

    // Very slow: 12 - 18 seconds
    const animDuration = 12000 + Math.random() * 6000;

    // Optional rotations (set to 0 for simplicity)
    const rotateStart = 0;
    const rotateEnd = 0;

    fragment.animate(
      [
        // 0%: start
        {
          offset: 0,
          transform: `translate(0,0) scale(0) rotate(${rotateStart}deg)`,
          opacity: 0,
        },
        // 10%: big "boom"
        {
          offset: 0.1,
          transform: `translate(${targetX * 0.8}px, ${targetY * 0.8}px)
                      scale(2) rotate(${rotateStart}deg)`,
          opacity: 1,
        },
        // 20%: full radius
        {
          offset: 0.2,
          transform: `translate(${targetX}px, ${targetY}px)
                      scale(1.7) rotate(${rotateEnd}deg)`,
          opacity: 1,
        },
        // 35%: drifting downward
        {
          offset: 0.35,
          transform: `translate(${targetX}px, ${targetY + rainDistance * 0.1}px)
                      scale(1.3) rotate(${rotateEnd}deg)`,
          opacity: 0.95,
        },
        // 50%
        {
          offset: 0.5,
          transform: `translate(${targetX}px, ${targetY + rainDistance * 0.3}px)
                      scale(1.1) rotate(${rotateEnd}deg)`,
          opacity: 0.8,
        },
        // 65%
        {
          offset: 0.65,
          transform: `translate(${targetX}px, ${targetY + rainDistance * 0.55}px)
                      scale(0.9) rotate(${rotateEnd}deg)`,
          opacity: 0.6,
        },
        // 80%
        {
          offset: 0.8,
          transform: `translate(${targetX}px, ${targetY + rainDistance * 0.8}px)
                      scale(0.8) rotate(${rotateEnd}deg)`,
          opacity: 0.3,
        },
        // 100%: end
        {
          offset: 1,
          transform: `translate(${targetX}px, ${targetY + rainDistance}px)
                      scale(0.6) rotate(${rotateEnd}deg)`,
          opacity: 0,
        },
      ],
      {
        duration: animDuration,
        easing: 'cubic-bezier(0.25, 0.5, 0.25, 1)',
        fill: 'forwards',
      }
    );

    setTimeout(() => {
      fragment.remove();
    }, animDuration + 500);
  }
}