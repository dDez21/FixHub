<footer class="footer">

    <div class="footer-info">    
        
        <!-- servizi -->
        <div class="footer-element">
            <p class="text">I nostri servizi</p>
            
            <!-- pagine selezionabili -->
            <ul class="small-text info">
                @foreach($navLinks as $link)
                    <li>
                        <a class="selected-footer" href="{{ url($link['path']) }}">{{ $link['label'] }}</a>
                    </li>
                @endforeach
            </ul>
            
        </div>
        

        <!-- orari -->
        <div class="footer-element">
            <p class="text">I nostri orari</p>

            <ul class="small-text info">
                <li>Lun - Ven: 09:00 - 12:30    14:30 - 18:30</li>
                <li>Sab: 09:00 - 12:30</li>
                <li>Domenica chiuso</li>
            </ul>
        </div>


        <!-- contatti -->
        <div class="footer-element">
            <p class="text">Contatti</p>

            <ul class="small-text info">
                <li class="elements">
                    <img class="icon" src="{{ asset('icon/location.png') }}" alt="" aria-hidden="true">
                    <span>Via Brecce Bianche, 12, Ancona, 60131</span>
                </li>

                <li class="elements">
                    <img class="icon" src="{{ asset('icon/call.png') }}" alt="" aria-hidden="true">
                    <span>+39 3881161585</span>
                </li>

                <li class="elements">
                    <img class="icon" src="{{ asset('icon/sms.png') }}" alt="" aria-hidden="true">
                    <span>support@fixtech.com</span>                
                </li>
            </ul>
        </div>
    </div>

    <!-- logo -->
    <div class="footer-brand">
        <img class="iconBrowser" src="{{ asset('icon/browIcon.png') }}" alt="" aria-hidden="true">
    </div>

    <!-- diritti -->
    <div class="footer-rights">
        <p class="small-text">© {{ date('Y') }} <strong>FixHub</strong> — Tutti i diritti riservati.</p>
    </div>
</footer>