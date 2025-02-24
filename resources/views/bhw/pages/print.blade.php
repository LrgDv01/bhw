
<style>
    @media print {
        body * {
            visibility: hidden;
        }
        #printable-table, #printable-table * {
            visibility: visible;
        }
        #printable-table {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
    }
    .logo-container {
        text-align: center;
        margin-bottom: 10px;
    }
    .logo-container img {
        width: 100px;
        height: auto;
        margin: 0 20px;
    }
    .report-title {
        text-align: center;
        font-weight: bold;
        font-size: 18px;
    }
</style>

<a href="{{ route('bhw.pages.list') }}" class="btn btn-primary">Back</a>
<button onclick="window.print()">Print</button>
<div class="pagetitle mb-5">
        <a href="{{ route('bhw.bhwform') }}" class="btn btn-primary">Fill</a>
    </div>

<div id="printable-table">
    <div class="logo-container">
        <img src="laguna-logo.png" alt="Laguna Logo">
        <img src="bhw-logo.png" alt="BHW Logo">
    </div>
    <div class="report-title">BHW ACTIVITIES MONTHLY REPORT</div>
    <table border="1" width="100%" style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="text-align: left;">PROGRAM/PROYEKTO AT MGA GAWAIN NG REG./ACCREDITED BHW'S</th>
                <th style="text-align: center;">BILANG NG NAGAWA</th>
            </tr>
        </thead>
                
            
        <tbody>
            <tr><td colspan="2"><strong>MATERNAL CARE PROGRAM</strong></td></tr>
            <tr><td colspan="2">1. Pre – Natal Care</td><td></td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;1.1. Bilang ng mga buntis na binigyan sa komadrona</td><td>{{ DB::table('family_members')->where('pregnant', 'YES')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;1.2. Bilang ng mga buntis na finollow-up ng komadrona</td><td>{{ $bhwData->last()->followed_up_pregnant_women ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;1.3. Bilang ng mga buntis na may plano sa panganganak</td><td>{{ DB::table('family_members')->where('birth_plan', 'YES')->count() }}</td></tr>
            <tr><td colspan="2">2. Post – Natal Care</td><td></td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;2.1. Bilang ng mga bata na bagong panganak</td><td>{{ $bhwData->last()->home_births ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;2.2. Bilang ng bata na Newborn Screening</td><td>{{ $bhwData->last()->newborn_screened ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;2.3. Bilang ng nanganak sa bahay</td><td>{{ $bhwData->last()->home_births ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;2.4. Bilang ng nanganak sa clinic</td><td>{{ $bhwData->last()->clinic_births ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;2.5. Bilang ng nanganak sa hospital</td><td>{{ $bhwData->last()->home_births ?? '' }}</td></tr>

            <tr><td colspan="2">3. Child Care</td><tr>
            <tr><td>&nbsp;&nbsp;&nbsp;3.1. Bilang ng mga bata na nabakunahan BCG</td><td>{{ DB::table('child_censuses')->whereJsonContains('vaccines', 'BCG')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;3.2. Bilang ng mga bata pinollow-up para bakunahan (0-11)</td><td>{{ $bhwData->last()->followed_up_for_vaccination ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;3.3. Bilang ng mga bata na nabigyan ng Vit.A (6-72 mos. Old)</td><td>{{ DB::table('child_censuses')->whereJsonContains('vaccines', 'VitaminA')->count() }}</td></tr>


            <tr><td colspan="2">4. FAMILY PLANNING</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;4.1. Bilang ng nanay na hindi nagpaplanong pamilya</td><td>{{ DB::table('family_members')->where('family_planning', 'NO')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;4.2. Bilang ng nanay at mga asawa na may plano ng pamilya</td><td>{{ DB::table('family_members')->where('family_planning', 'YES')->count() }}</td></tr>
       
            <tr><td colspan="2">5. NATIONAL TUBERCULOSIS CONTROL PROGRAM</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;5.1. Bilang ng pasyente na may sintomas ng TB</td><td>{{ DB::table('family_members')->where('tb_symptoms', 'YES')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;5.2. Bilang ng pasyenteng nakunan ng plema</td><td>{{ $bhwData->last()->sputum_collected ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;5.3. Bilang ng pasyente na may positive sputum</td><td>{{ DB::table('family_members')->where('sputum_result', 'Positive')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;5.4. Bilang ng pasyente na may TB na may Treatment Partner</td><td>{{ DB::table('family_members')->where('tb_treatment_partner', 'YES')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;5.5. Bilang ng pasyente na pina-follow up</td><td>{{ $bhwData->last()->followed_up_patients ?? '' }}</td></tr>

            <tr><td colspan="2">6. CARDIOVASCULAR TUBERCULOSIS CONTROL PROGRAM</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;6.1. Bilang ng pasyente na mataas ang presyon</td><td>{{ DB::table('family_members')->where('hypertension_experience', 'YES')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;6.2. Bilang ng pasyente na pinollow-up</td><td>{{ $bhwData->last()->followed_up_patient ?? '' }}</td></tr>

            <tr><td colspan="2">7. ENVIRONMENTAL SANITATION</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;7.1. Bilang ng bahay na may palikuran</td><td>{{ DB::table('family_members')->where('own_toilet', 'YES')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;7.2. Bilang ng bahay na walang palikuran</td><td>{{ DB::table('family_members')->where('own_toilet', 'NO')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;7.3. Bilang ng bahay na may pinagkukunan ng malinis na tubig</td><td>{{ DB::table('family_members')->where('clean_water_source', 'YES')->count() }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;7.4. Bilang ng bahay na walang pinagkukunan ng malinis na tubig</td><td>{{ DB::table('family_members')->where('clean_water_source', 'NO')->count() }}</td></tr>

            <tr><td colspan="2">8. CLINIC DUTY:(BHS/RHU)TO ASSIST RHM-bilang ng duty sa loob ng isang (1)buwan</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;MBHW- Federation Meeting (Bilang ng dalo sa Pambayang Pagpupulong ng mga BHW)</td><td>{{ $bhwData->last()->mbhw_meeting_attendance ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;PFBHW- Federation Meeting (Bilang ng dalo sa Panlalawigang Pagpupulong ng mga Pangulo)</td><td>{{ $bhwData->last()->pfbhw_meeting_attendance ?? '' }}</td></tr>

            <tr><td colspan="2">9. REFERRAL</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;9.1. Mga pasyente na dinala sa BHS/Hospital at MAY referral</td><td>{{ $bhwData->last()->referred_patients ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;9.2. Mga pasyente na dinala sa BHS/Hospital at WALANG referral</td><td>{{ $bhwData->last()->non_referred_patients ?? '' }}</td></tr>

            <tr><td colspan="2">10. PROJECT</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.1. Daming pamilya na nasurvey sa barangay</td><td>{{ $bhwData->last()->surveyed_families ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.2. Pagtitinda ng iodized salt sa inyong household</td><td>{{ $bhwData->last()->iodized_salt_sold ?? '' }}</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;10.3. Dengue Barangay Brigade/Larva Survey bilang ng malinis na tirahan ng lamok</td><td>{{ $bhwData->last()->clean_larvae_habitats ?? '' }}</td></tr>

            <tr><td colspan="2">BIRTHS COVERED</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;11. Kabuuang ipinanganak sa household covered</td><td>{{ $bhwData->last()->total_births_in_area ?? '' }}</td></tr>


            <tr><td colspan="2">DEATH COVERED</td></tr>
            <tr><td>&nbsp;&nbsp;&nbsp;12. Kabuuang namatay sa household covered</td><td>{{ $bhwData->last()->total_deaths_in_area ?? '' }}</td></tr>
        </tbody>
    </table>
    <table width="100%" >
    <tbody>
    <tr>
        <td >Ginawa at Isinumite ni:</td>
        <td >Pinagtibay nina:</td>
    </tr>
    <tr>
        <td>BHW: __________________________</td>
        <td>Pirma: ________________________</td>
    </tr>
    <tr>
    </tr>
    <tr>
        <td>MARIA LUWALHATI RELLOSA DE TORRES, MD.</td>
        <td>DR. RENE P. BAGAMASBAD, MD., CHA</td>
    </tr>
    </tbody>
    </table>
</div>

