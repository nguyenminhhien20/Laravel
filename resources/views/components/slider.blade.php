<!-- Banner -->
<section class="relative h-[520px] md:h-[600px] rounded-[35px] mx-3 md:mx-10 mt-6
    overflow-hidden shadow-[0_0_60px_-5px_rgba(255,20,147,0.55)]
    ring-1 ring-rose-400/20">

    <!-- Ảnh nền -->
    <div id="banner"
        class="absolute inset-0 w-full h-full bg-cover bg-center transition-all
        duration-[1200ms] ease-in-out opacity-0">
    </div>

    <!-- Overlay gradient tăng rõ nội dung -->
    <div class="absolute inset-0 bg-gradient-to-b
        from-[#000000]/70 via-[#0f0a0c]/40 to-[#000000]/85"></div>

    <!-- Glow background -->
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,rgba(255,0,128,0.15),transparent_70%)]"></div>

    <!-- Nội dung -->
    <div id="bannerContent"
        class="absolute inset-0 flex flex-col items-center justify-center
        text-center text-white z-20 px-6 select-none gap-4 opacity-0
        translate-y-4 transition-all duration-700 ease-out">

        <!-- Tiêu đề -->
        <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight leading-tight">
            <span class="bg-gradient-to-r from-rose-400 to-pink-500
                bg-clip-text text-transparent drop-shadow-[0_0_25px_rgba(255,20,147,0.6)]">
                Premium
            </span>
            <span class="text-white">Footwear</span>
        </h1>

        <p class="text-lg md:text-2xl opacity-95 font-light tracking-wide">
            Ưu đãi lên đến <span class="font-bold text-yellow-300">45%</span> ⚡ Duy nhất hôm nay!
        </p>

        <!-- CTA Animation -->
        <a href="{{ route('site.product') }}"
            class="group inline-flex items-center gap-2 px-10 py-3 rounded-full mt-3
                font-semibold uppercase tracking-wider
                text-rose-300 border border-rose-400/80
                bg-white/10 backdrop-blur-md
                transition-all duration-300
                hover:bg-gradient-to-r hover:from-rose-500 hover:to-pink-500
                hover:text-white hover:shadow-[0_0_45px_rgba(255,20,147,0.9)]
                hover:scale-110 active:scale-95
                animate-[pulse_2s_ease-in-out_infinite]">
            Săn ngay
            <span class="text-xl transition-transform duration-300 group-hover:translate-x-1">
                ⚡
            </span>
        </a>
    </div>

    <!-- Navigation Buttons -->
    <button id="prev"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-30
        bg-white/10 hover:bg-rose-400/45 backdrop-blur-xl
        text-white w-12 h-12 rounded-full border border-white/25
        flex items-center justify-center transition-all
        hover:scale-125 shadow-[0_0_25px_rgba(255,20,147,0.5)]">
        <span class="text-2xl">‹</span>
    </button>

    <button id="next"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-30
        bg-white/10 hover:bg-rose-400/45 backdrop-blur-xl
        text-white w-12 h-12 rounded-full border border-white/25
        flex items-center justify-center transition-all
        hover:scale-125 shadow-[0_0_25px_rgba(255,20,147,0.5)]">
        <span class="text-2xl">›</span>
    </button>

    <!-- Dots -->
    <div id="dots"
        class="absolute bottom-6 w-full flex justify-center gap-3 z-30"></div>

</section>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const images = [
        "build/assets/images/banner11.jpg",
        "build/assets/images/banner1.avif",
        "build/assets/images/banner33.jpg",
        "build/assets/images/banner4.jpg",
    ];

    let currentIndex = 0;
    const banner = document.getElementById("banner");
    const dotsContainer = document.getElementById("dots");
    const content = document.getElementById("bannerContent");

    images.forEach((_, i) => {
        const dot = document.createElement("div");
        dot.className = `w-3 h-3 rounded-full transition-all cursor-pointer
            bg-rose-300/40 animate-[pulse_3s_infinite]`;
        dot.addEventListener("click", () => goToSlide(i));
        dotsContainer.appendChild(dot);
    });

    const dots = dotsContainer.children;

    function updateBanner() {
        // Image fade animation
        banner.style.opacity = 0;
        content.style.opacity = 0;
        content.style.transform = "translateY(10px)";

        setTimeout(() => {
            banner.style.backgroundImage = `url('${images[currentIndex]}')`;
            banner.style.opacity = 1;
            content.style.opacity = 1;
            content.style.transform = "translateY(0)";
        }, 300);

        [...dots].forEach((dot, i) => {
            dot.style.background = i === currentIndex
                ? "linear-gradient(135deg,#ff4fa8,#f72585)"
                : "rgba(255,105,180,0.4)";
            dot.style.width = i === currentIndex ? "15px" : "10px";
            dot.style.height = i === currentIndex ? "15px" : "10px";
            dot.style.boxShadow = i === currentIndex
                ? "0 0 20px rgba(255,20,147,0.9)"
                : "none";
        });
    }

    const goToSlide = (i) => {
        currentIndex = i;
        updateBanner();
    };

    document.getElementById("next").onclick = () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateBanner();
    };

    document.getElementById("prev").onclick = () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateBanner();
    };

    updateBanner();
    setInterval(() => {
        currentIndex = (currentIndex + 1) % images.length;
        updateBanner();
    }, 6000);
});
</script>
