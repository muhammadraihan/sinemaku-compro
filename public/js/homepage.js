// Hero Slides Data
var heroSlides = [
  {
    title: 'PERAYAAN MATI RASA',
    year: '2024',
    starring: 'Iqbaal Ramadhan',
    tagline: 'Berfokus pada kisah seorang anak pertama bernama Ian Antono yang bercita-cita menjadi musisi.',
    image: 'https://akcdn.detik.net.id/visual/2025/01/29/film-perayaan-mati-rasa-2025-1_169.png?w=1200',
    link: '/movie/midnight'
  },
  {
    title: 'KETIKA BERHENTI DI SINI',
    year: '2023',
    starring: 'Prilly Latuconsina',
    tagline: 'Berkisah tentang Anindita Semesta yang bertemu dengan Ed dalam pertemuan tak terduga.',
    image: 'https://occ-0-8407-92.1.nflxso.net/dnm/api/v6/Z-WHgqd_TeJxSuha8aZ5WpyLcX8/AAAABSYpb03lAZrLnddgej_eO3wCckPgtY5MmDCR121DeRMVx7bZK9YxBJsIhtgUR4SX_54-tAdzK6RQ0o3liqnWTO0c7TTsZTDcZ4jM.jpg?r=e6d',
    link: '/movie/echoes-tomorrow'
  },
  {
    title: 'KU KIRA KAU RUMAH',
    year: '2021',
    starring: 'Jourdy Pranata',
    tagline: 'Sebuah perjalanan emosional tentang pencarian makna rumah dan keluarga.',
    image: 'https://imgsrv2.voi.id/_nvSjjN1kQP13Ow4BgSP8-V_iHBdRggEruAyAOy4Hn0/auto/1200/675/sm/1/bG9jYWw6Ly8vcHVibGlzaGVycy8xMzIwNTYvMjAyMjAyMDcxMzMzLW1haW4uanBn.jpg',
    link: '/movie/silent-waters'
  },
  {
    title: 'BOLEHKAH SEKALI SAJA KUMENANGIS',
    year: '2024',
    starring: 'Pradikta Wicaksono',
    tagline: 'Tari (Prilly Latuconsina) harus berjuang menghadapi situasi yang tidak dikehendaki oleh siapapun. Sifat temperamen sang ayah membuat Tari dan kakaknya trauma hingga sang kakak memutuskan untuk keluar dari rumah yang membuat hatinya terasa sakit.',
    image: 'https://occ-0-8407-114.1.nflxso.net/dnm/api/v6/E8vDc_W8CLv7-yMQu8KMEC7Rrr8/AAAABRApQiafj0_-u6nK5_xjajzLUz1lHiTxCVo12rRvGE0FCWIlhVe_fE7yXMLuJROUwwvMnznIrjHbv80RWh4Xt8km4Yg5SIyjKhaO.jpg?r=917',
    link: '/movie/silent-waters'
  }
];

var jobVacancies = [
  { title: 'Lead Cinematographer', department: 'Production', location: 'Jakarta' },
  { title: 'Sound Designer', department: 'Post-Production', location: 'Remote' },
  { title: 'VFX Supervisor', department: 'Visual Effects', location: 'Jakarta' },
  { title: 'Script Supervisor', department: 'Production', location: 'Bandung' },
  { title: 'Casting Director', department: 'Creative', location: 'Jakarta' },
  { title: 'Marketing Manager', department: 'Marketing', location: 'Jakarta' }
];

// Hero Slider Logic
var currentSlide = 0;
function setHeroSlide(idx) {
  currentSlide = idx;
  $("#hero-title").text(heroSlides[idx].title);
  $("#hero-year").text(heroSlides[idx].year);
  $("#hero-starring").text('Starring ' + heroSlides[idx].starring);
  $("#hero-tagline").text(heroSlides[idx].tagline);
  $("#hero-explore-link").attr('href', heroSlides[idx].link);
  $("#hero-film-counter").text(('0'+(idx+1)).slice(-2) + ' — ' + ('0'+heroSlides.length).slice(-2));
  var dots = '';
  for (var i=0; i<heroSlides.length; i++) {
    dots += `<button onclick="setHeroSlide(${i})" class="w-px h-8 ${i==idx ? 'bg-white scale-110' : 'bg-white/30 hover:bg-white/60'} transition-all duration-500"></button>`;
  }
  $("#hero-progress-indicator").html(dots);
  $("#hero-bg-slides").html(
    heroSlides.map(function(slide, i){
      return `<div class="absolute inset-0 hero-background ${i==idx?'opacity-60':'opacity-0'}" style="background-image:url('${slide.image}');background-size:cover;background-position:center;"></div>`;
    }).join('')
  );
}

$(function(){
  // Hero Video Fade-In
  $("#hero-video").on("loadeddata", function(){
    $(this).addClass("opacity-100").removeClass("opacity-0");
  });
  setHeroSlide(0);
  setInterval(function(){
    setHeroSlide((currentSlide+1)%heroSlides.length);
  }, 4000);
  // Scroll Down
  $("#scroll-shop-btn").on("click", function(){
    var nextSection = $("#shop-section");
    if(nextSection.length) nextSection[0].scrollIntoView({behavior:"smooth", block:"start"});
  });

  // Inject Job Vacancies
  var jobsHtml = "";
  jobVacancies.forEach(function(job){
    jobsHtml += `
      <div class="bg-white p-8 shadow-lg hover:shadow-xl transition-all duration-500 group hover-lift">
        <div class="space-y-4">
          <h3 class="text-xl font-semibold group-hover:text-gray-600 transition-colors duration-300">${job.title}</h3>
          <p class="text-gray-600 editorial-text">${job.department}</p>
          <div class="flex items-center text-gray-500 text-sm">
            <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 12.414a4 4 0 1 0-1.414 1.414l4.243 4.243a1 1 0 0 0 1.414-1.414z"/><circle cx="11" cy="11" r="8" /></svg>
            ${job.location}
          </div>
          <button class="w-full px-4 py-3 bg-black text-white font-semibold tracking-wide hover:bg-gray-800 transition-colors duration-300 btn-cinematic">APPLY</button>
        </div>
      </div>
    `;
  });
  $("#jobs-grid").html(jobsHtml);
});
