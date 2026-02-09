<?php

namespace Database\Seeders;

use App\Models\Center;
use App\Models\User;
use App\Models\Category;
use App\Models\Malfunction;
use App\Models\Product;
use App\Models\Tech;

//per immagini
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        //seeder admin, tecnico e staff
        $admin = User::create([
            'username' => 'adminadmin',
            'password' => bcrypt('bvFKbvFK'),
            'name' => 'Admin',
            'surname' => 'User',
            'role' => 'admin',
        ]);

        $tecn = User::create([
            'username' => 'tecntecn',
            'password' => bcrypt('bvFKbvFK'),
            'name' => 'Luca',
            'surname' => 'Rossi',
            'role'=> 'tech',
        ]);

        $staff = User::create([
            'username' => 'staffstaff',
            'password' => bcrypt('bvFKbvFK'),
            'name' => 'Mario',
            'surname' => 'Bianchi',
            'role'=> 'staff',
            ]);


        //seeder centri assistenza
        $center = Center::create([
            'name' => 'Tutto elettronica',
            'phone' => '3634262456',
            'email'=> 'support.milano@fixtech.com',
            'region_id' => 'Lombardia',
            'province_id' => 'MI',
            'city_id' => 'Milano',
            'street' => 'Via Roma',
            'civic' => '123',
        ]);

        $centerUser = Center::create([
            'name' => 'Centro Assistenza',
            'phone' => '3881161585',
            'email'=> 'support.osimostz@fixhub.com',
            'region_id' => 'Marche',
            'province_id' => 'AN',
            'city_id' => 'Osimo Stazione',
            'street' => 'Via D\'Azeglio',
            'civic' => '3',
        ]);


        $center = Center::create([
            'name' => 'Dorica Service',
            'phone' => '3469234672',
            'email'=> 'support.ancona@fixhub.com',
            'region_id' => 'Marche',
            'province_id' => 'AN',
            'city_id' => 'Ancona',
            'street' => 'Via Ruggeri',
            'civic' => '6',
        ]);


        $center = Center::create([
            'name' => 'TT - Techno Turin',
            'phone' => '3130348893',
            'email'=> 'support.torino@fixhub.com',
            'region_id' => 'Piemonte',
            'province_id' => 'TO',
            'city_id' => 'Torino',
            'street' => 'Via Nizza',
            'civic' => '46',
        ]);


        $center = Center::create([
            'name' => 'FixHub Roma',
            'phone' => '3774142590',
            'email'=> 'support.roma@fixhub.com',
            'region_id' => 'Lazio',
            'province_id' => 'RM',
            'city_id' => 'Roma',
            'street' => 'Via Mazzarino',
            'civic' => '13',
        ]);


        $center = Center::create([
            'name' => 'Napolitech',
            'phone' => '3924115833',
            'email'=> 'support.napoli@fixhub.com',
            'region_id' => 'Campania',
            'province_id' => 'NA',
            'city_id' => 'Napoli',
            'street' => 'Via Duomo',
            'civic' => '96',
        ]);


        $center = Center::create([
            'name' => 'Rinascimento tecnologico',
            'phone' => '3852156675',
            'email'=> 'support.firenze@fixhub.com',
            'region_id' => 'Toscana',
            'province_id' => 'FI',
            'city_id' => 'Firenze',
            'street' => 'Via Ghibellina',
            'civic' => '127',
        ]);


        //seeder categorie
        $catComputer = Category::firstOrCreate(['name' => 'Computer']);
        $catTelefoniTablet = Category::firstOrCreate(['name' => 'Telefoni e Tablet']);
        $catStampantiScanner = Category::firstOrCreate(['name' => 'Stampanti e Scanner']);
        $catConsoleGaming = Category::firstOrCreate(['name' => 'Console e Gaming']);
        $catWiFi = Category::firstOrCreate(['name' => 'WiFi']);
    


        //seeder tecnico
        $tech = Tech::create([
                'user_id' => $tecn->id,
                'center_id' => $centerUser->id,
                'birth_date' => '1999-05-20',
            ]);

        //associo categorie al tecnico
        $tecn->categories()->sync([
            $catComputer->id,
            $catTelefoniTablet->id,
        ]);

        //associo categorie allo staff
        $staff->categories()->sync([
            $catStampantiScanner->id,
            $catWiFi->id,
        ]);


        //immagine prodotto non esistente
        $this->seedImage('noPhoto.png');

        //seeder prodotti
        $prod = Product::create([
            'name' => 'Apple MacBook Air (M2)',
            'photo' => $this->seedImage('apple_macBook_Air_M2.png'),
            'category_id' => '1',
            'description' => 'Notebook leggero e fanless, adatto a studio e produttività con ottima autonomia.',
            'use_techniques' => 'Aggiornare macOS regolarmente. Usare hub USB-C di qualità per monitor/ethernet. Evitare superfici che trattengono calore durante carichi prolungati.',
            'installation'=> 'Configura Apple ID -> aggiorna macOS -> attiva il backup -> collega le periferiche',
        ]);

        Malfunction::create([
            'name' => 'Autonomia ridotta improvvisa',
            'description' => 'La batteria scende rapidamente anche con utilizzo leggero o a schermo spento.',
            'solution' => 'Controlla “Monitoraggio Attività” per processi energivori, disattiva app in avvio automatico, verifica stato batteria in Impostazioni, aggiorna macOS e fai un riavvio. Se persiste: reset SMC non applicabile su Apple Silicon -> prova spegnimento completo e aggiornamento; se ancora nulla, diagnosi in assistenza.',
            'product_id' => $prod->id,
        ]);

        $prod = Product::create([
            'name' => 'Dell XPS 13 (9315)',
            'photo' => $this->seedImage('dell_XPS_13_9315.png'),
            'category_id' => '1',
            'description' => 'Ultrabook compatto da 13" pensato per mobilità e lavoro quotidiano.',
            'use_techniques' => 'Aggiornare driver/BIOS (Dell Update). Non usarlo su letto/divano per non ostruire la dissipazione. Per dock/monitor usare USB-C compatibili.',
            'installation'=> 'Setup Windows -> Windows Update -> installazione driver/BIOS -> test porte USB-C/audio/video.',
        ]);

        Malfunction::create([
            'name' => 'Non ricarica tramite USB-C',
            'description' => 'Collegando l’alimentatore USB-C, la carica non parte o va a intermittenza.',
            'solution' => 'Prova altro cavo/alimentatore certificato, pulisci la porta USB-C, aggiorna BIOS e driver chipset/Thunderbolt, verifica impostazioni di gestione energia. Se con alimentatore originale persiste, probabile problema porta/board: assistenza.',
            'product_id' => $prod->id,
        ]);

        $prod = Product::create([
            'name' => 'Apple iPhone 15',
            'photo' => $this->seedImage('apple_iphone15.png'),
            'category_id' => '2',
            'description' => 'Smartphone iOS con aggiornamenti regolari e integrazione nell’ecosistema Apple.',
            'use_techniques' => 'Attivare backup (iCloud o PC/Mac). Tenere iOS aggiornato. Controllare spazio libero e stato batteria se il dispositivo rallenta.',
            'installation'=> 'Setup iniziale → login Apple ID → aggiornamento iOS → Face ID → backup → ripristino/trasferimento dati (se serve).',
        ]);

        Malfunction::create([
            'name' => 'Ricarica lenta o assente via USB-C',
            'description' => 'Il telefono non carica, carica molto lentamente o si disconnette durante la ricarica.',
            'solution' => 'Pulisci delicatamente la porta USB-C da polvere/lanugine, prova cavo certificato e alimentatore adeguato, verifica se compare “Accessorio non supportato”, riavvia e aggiorna iOS. Se non cambia, test in assistenza per porta USB-C.',
            'product_id' => $prod->id,
        ]);

        Malfunction::create([
            'name' => 'Microfono con audio ovattato in chiamata',
            'description' => 'In chiamata o nei vocali l’audio risulta basso/ovattato, soprattutto in vivavoce.',
            'solution' => 'Verifica che non ci siano pellicole/cover che coprono i fori microfono, pulisci le griglie, prova registrazione con Memo Vocali, disattiva riduzione rumore/app terze. Aggiorna iOS. Se persiste, possibile danno hardware: assistenza.',
            'product_id' => $prod->id,
        ]);

        $prod = Product::create([
            'name' => 'Apple iPad (10ª generazione)',
            'photo' => $this->seedImage('apple_iPad_10g.png'),
            'category_id' => '2',
            'description' => 'Tablet per studio/ufficio e consultazione documenti, con iPadOS.',
            'use_techniques' => 'Tenere iPadOS aggiornato. Usare accessori compatibili (tastiera/penna).',
            'installation'=> 'Setup iPadOS → aggiornamento → Apple ID → backup → collegamento accessori → test Wi-Fi.',
        ]);

        Malfunction::create([
                'name' => 'Wi-Fi instabile o disconnessioni',
                'description' => 'Il tablet perde la rete o rallenta dopo qualche minuto, anche vicino al router.',
                'solution' => 'Riavvia iPad e router, dimentica la rete e riconnettiti, prova banda 5 GHz/2.4 GHz, disattiva VPN, aggiorna iPadOS, reset impostazioni rete. Se solo su una rete dà problemi: controlla canale Wi-Fi e interferenze.',
                'product_id' => $prod->id,
            ]);

         Malfunction::create([
            'name' => 'Accessorio (penna/tastiera) non viene rilevato',
            'description' => 'L’accessorio non si abbina o non funziona correttamente dopo il collegamento.',
            'solution' => 'Verifica compatibilità modello/accessorio, ricarica l’accessorio, dissocia e riassocia Bluetooth, aggiorna iPadOS. Se è USB-C: prova altro cavo/adattatore, pulisci porta. Se continua: test su altro dispositivo o assistenza.',
            'product_id' => $prod->id,
        ]);

        $prod = Product::create([
            'name' => 'Samsung Galaxy S24 Plus',
            'photo' => $this->seedImage('samsung_galaxy_S24.png'),
            'category_id' => '2',
            'description' => 'Smartphone Android fascia alta con interfaccia One UI e funzioni avanzate.',
            'use_techniques' => 'Aggiornare patch di sicurezza. Gestire permessi app. Se consumo anomalo: controllare app in background e ottimizzazione batteria.',
            'installation'=> 'Setup Android → aggiornamenti → account Google/backup → configurazione Wi-Fi/5G → test chiamate e app base.',
        ]);

        $prod = Product::create([
            'name' => 'HP LaserJet Pro M404dn',
            'photo' => $this->seedImage('hp_LaserJet_Pro_M404dn.png'),
            'category_id' => '3',
            'description' => 'Stampante laser monocromatica da ufficio con rete cablata.',
            'use_techniques' => 'In rete conviene installare via IP. Per inceppamenti: controllare percorso carta e rulli. Usare driver ufficiali per funzioni complete.',
            'installation'=> 'Collegare Ethernet → ottenere IP → installare driver → aggiungere stampante via IP → stampa di test.',
        ]);

        $prod = Product::create([
            'name' => 'Epson EcoTank ET-2850',
            'photo' => $this->seedImage('epson_EcoTank_ET2850.png'),
            'category_id' => '3',
            'description' => 'Inkjet con serbatoi ricaricabili (EcoTank), pensata per ridurre costo per pagina.',
            'use_techniques' => 'Primo riempimento con attenzione. Se righe/sbiadimenti: controllo ugelli e pulizia testina. Non lasciare inchiostri aperti.',
            'installation'=> 'Riempire serbatoi → inizializzazione → configurare Wi-Fi → installare Epson software → stampa test.',
        ]);

        $prod = Product::create([
            'name' => 'Sony DualSense Wireless Controller',
            'photo' => $this->seedImage('sony_controller.png'),
            'category_id' => '4',
            'description' => 'Controller ufficiale PS5 con feedback aptico e grilletti adattivi.',
            'use_techniques' => 'Aggiornare firmware quando richiesto. In caso di drift: reset controller e calibrazione.',
            'installation'=> 'Abbinare via USB/BT → aggiornare firmware → test tasti/analogici → configurazioni accessibilità.',
        ]);

        $prod = Product::create([
            'name' => 'Sony PlayStation 5',
            'photo' => $this->seedImage('sony_PlayStation_5.png'),
            'category_id' => '4',
            'description' => 'Console Sony con SSD e aggiornamenti di sistema.',
            'use_techniques' => 'Lasciare spazio per ventilazione. Per online stabile: Ethernet. Se problemi: verificare NAT/DNS del router.',
            'installation'=> 'Collegare HDMI+alimentazione → setup account → aggiornamento firmware → configurare rete → test store/download.',
        ]);

        $prod = Product::create([
            'name' => 'Nintendo Switch (Modello OLED)',
            'photo' => $this->seedImage('Nintendo_SwitchOLED.png'),
            'category_id' => '4',
            'description' => 'Console ibrida Nintendo (portatile + dock TV) con schermo OLED.',
            'use_techniques' => 'Aggiornare firmware e Joy-Con. Se drift: calibrare stick, aggiornare controller, verificare usura.',
            'installation'=> 'Setup → aggiornamenti → collegare dock a TV → configurare Wi-Fi → account Nintendo.',
        ]);

        $prod = Product::create([
            'name' => 'TP-Link Archer AX55 (Wi-Fi 6)',
            'photo' => $this->seedImage('TP-Link_Archer_AX55.png'),
            'category_id' => '5',
            'description' => 'Router Wi-Fi 6 per casa/ufficio con buone prestazioni e gestione semplice.',
            'use_techniques' => 'Cambiare password admin e SSID. Attivare WPA2/WPA3. Aggiornare firmware per sicurezza. Posizionare in alto e lontano da ostacoli.',
            'installation'=> 'Collegare WAN al modem → setup da app/web → configurare SSID+sicurezza → update firmware → test copertura.',
        ]);

        $prod = Product::create([
            'name' => 'ASUS RT-AX86U (Wi-Fi 6)',
            'photo' => $this->seedImage('ASUS_RT-AX86U.png'),
            'category_id' => '5',
            'description' => 'Router Wi-Fi 6 con funzioni avanzate (QoS) spesso usato anche per gaming.',
            'use_techniques' => 'Disabilitare WPS se non serve. Configurare QoS per priorità traffico. Aggiornare firmware.',
            'installation'=> 'Collegare WAN → wizard ASUSWRT → SSID+WPA3 → firmware → QoS/guest network → test ping/velocità.',
        ]);
    }


    // salvo immagine nello storage pubblico
    private function seedImage(string $photoName): string{

        // prendo nome immagine
        $photoName = ltrim($photoName, '/');

        // prendo percorso immagine
        $source = database_path('seeders/products/' . $photoName);

        //destinazione
        $dest = 'products/' . $photoName;

        // se non esiste, uso un file di default
        if (!File::exists($source)) {
            $source = database_path('seeders/products/noPhoto.png');
            $dest = 'products/noPhoto.png';
            
            // se manca anche foto di default ritorno null
            if (!File::exists($source)) {
                return '';
            }
        }

    // mando tutto al db
    Storage::disk('public')->put($dest, File::get($source));
    return $dest;
    }
}
