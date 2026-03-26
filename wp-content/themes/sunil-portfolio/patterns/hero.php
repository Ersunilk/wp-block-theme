<?php
/**
 * Title: Portfolio Hero
 * Slug: sunil-portfolio/hero
 * Categories: sunil-portfolio
 */
?>
<!-- wp:html -->
<section class="min-h-screen flex flex-col md:flex-row items-center pt-24 px-8 md:px-16 mb-24 overflow-hidden" id="hero">
    <div class="w-full md:w-2/5 grid grid-cols-2 gap-4 h-[600px] mb-12 md:mb-0">
        <div class="col-span-1 h-full bg-zinc-100 overflow-hidden">
            <img alt="Abstract Architecture" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=800"/>
        </div>
        <div class="col-span-1 flex flex-col gap-4">
            <div class="h-1/2 bg-zinc-100 overflow-hidden">
                <img alt="Technical" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=400"/>
            </div>
            <div class="h-1/2 bg-zinc-100 overflow-hidden">
                <img alt="Clean Interior" class="w-full h-full object-cover filter grayscale hover:grayscale-0 transition-all duration-700" src="https://images.unsplash.com/photo-1497366216548-37526070297c?w=400"/>
            </div>
        </div>
    </div>
    <div class="w-full md:w-3/5 md:pl-20 flex flex-col justify-center">
        <span class="block text-sm uppercase tracking-[0.3em] font-bold mb-6 text-zinc-400">Strategy • Engineering • Design</span>
        <h1 class="text-6xl lg:text-8xl font-black letter-spacing-tighter leading-[0.9] mb-8">
            WordPress <br/>
            <span class="font-serif italic font-bold">Solutions</span> <br/>
            <span class="text-gradient">Architect</span>
        </h1>
        <p class="text-xl md:text-2xl text-zinc-600 max-w-xl leading-relaxed font-light">
            Deploying <span class="text-black font-semibold">enterprise-grade</span> technical infrastructures for brands that demand performance without aesthetic compromise.
        </p>
        <div class="mt-12">
            <a class="inline-flex items-center gap-4 group" href="#work">
                <span class="w-12 h-12 rounded-full border border-black flex items-center justify-center group-hover:bg-black group-hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                </span>
                <span class="text-sm font-black uppercase tracking-widest">Explore Systems</span>
            </a>
        </div>
    </div>
</section>
<!-- /wp:html -->