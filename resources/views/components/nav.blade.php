<nav class="fixed top-0 flex items-center w-full justify-between p-8 z-30" style="
    background: rgba(0,0,0,0.5);
-webkit-backdrop-filter: blur(10px);
backdrop-filter: blur(10px);
border: 1px solid rgba(0,0,0,0.25);
">
    <a href="{{route('front.index')}}" class="flex items-center gap-3 font-semibold text-aktiv-orange">
        <img src="{{asset('assets/images/logos/Logo.svg')}}" class="w-16 h-auto flex shrink-0" alt="logo">
        Kementerian Sosial <br> Republik Indonesia
    </a>
    <ul class="flex items-center justify-center gap-8">
        <li class="font-medium text-white hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
            <a href="{{route('front.check_booking')}}">Informasi Bantuan</a>
        </li>
        <li class="font-medium text-white hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
            <a href="">Workshop</a>
        </li>
        <li class="font-medium text-white hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
            <a href="">Community</a>
        </li>
        <li class="font-medium text-white hover:font-semibold hover:text-aktiv-orange transition-all duration-300">
            <a href="">Testimony</a>
        </li>
    </ul>
</nav>
