
@include('bhw.partials.__header')
@include('admin.partials.__nav')

<style>
    .print-template {
        width: 100%;
        display:flex;
        justify-content:center;
        font-family: Arial, sans-serif;
    }
    .report-table {
        width: 90%;
        border-collapse: collapse;
        font-size: 12pt;
    }
    .report-table th, .report-table td {
        border: 1px solid #000;
        padding: 8px;
      
    }
    .report-table th:nth-child(2), .report-table td:nth-child(2) {
        text-align: center;
        width: 20%;
    }
    .report-table th:first-child, .report-table td:first-child {
        width: 80%;
    }
    .section-title {
        font-weight: bold;
        background-color: #e0e0e0;
    }
    .text-center {
        text-align: center;
    }
    .header-top {
        padding: 10px;
    }
    .header-container {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .header-logo {
        width: 100px;
        height: auto;
    }
    .left-logo {
        margin-right: 20px;
    }
    .right-logo {
        margin-left: 20px;
    }
    .header-text {
        padding: 20px;
        text-align: center;
        font-size: 11pt;
        line-height: 1.4;
    }

    .footer-text {
        padding:20px;
        text-align: start;
        font-size: 11pt;
        border: 1px solid #000; 
    }

    @media print {
        .print-template {
            margin: 0;
            padding: 0;
        }
        .report-table {
            page-break-inside: auto;
        }
        .report-table tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        .section-title, .sub-section {
            page-break-before: avoid;
        }
        body * {
            visibility: hidden;
        }
        .print-template, .print-template * {
            visibility: visible;
        }
        .print-template {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
        }
        .header-logo {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .report-table tfoot {
            page-break-after: avoid;
        }
    }
</style>

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1 class="fs-4"><strong>OVERALL MONTHLY REPORT</strong></h1>
    </div>
    <section class="section monthly-report">

    <div class="text-center d-flex justify-content-between my-5 mx-3">
  
        {{--       <a href="{{ route('bhw.pages.list') }}" class="btn btn-primary">Back</a>--}}
        <a href="{{ route('bhw.bhwform') }}" class="btn btn-outline-primary border-1 px-5 py-2 fw-bold rounded rounded-3">Edit / Fill</a>
        <button onclick="window.print()" class="btn btn-outline-secondary border-1 px-5 py-2 fw-bold rounded rounded-3">Print Report</button>
 
     </div>


<div class="print-template">
    <table class="report-table">
        <thead>
            <tr>
                <th colspan="2" class="header-top">
                    <div class="header-container">
                        <img src="{{ URL::asset('img/bhw-logo.png') }}" alt="BHW Logo" class="header-logo left-logo">
                        <div class="header-text">
                            Provincial Government of Laguna <br>
                            PROVINCIAL HEALTH OFFICE <br>
                            Sta. Cruz, Laguna <br>
                            Tel. No. (049) 501-1523 / (049) 576-6141
                        </div>
                        <img src="{{ URL::asset('img/laguna-logo.png') }}" alt="Laguna Logo" class="header-logo right-logo">
                    </div>
                </th>
            </tr>
            <tr>
                <th colspan="2" class="text-center">
                    BHW ACTIVITIES MONTHLY REPORT <br>_______________________, 2025 <br> BARANGAY ______________, STA. MARIA, LAGUNA
                </th>
            </tr>
            <tr>
                <th class="text-center">PROGRAM/PROYEKTO AT MGA GAWAIN NG REG./ACCREDITED BHW'S</th>
                <th>BILANG NG NAGAWA</th>
            </tr>
        </thead>
        <tbody>
            <tr><td colspan="2" class="section-title">1. MATERNAL CARE PROGRAM</td></tr>
            <tr>
                <td>1.1. Bilang ng mga buntis na binigyan sa komadrona</td>
                <td>{{ DB::table('mother_census')->where('pregnant', 'Yes')->count() }}</td>
            </tr>
            <tr>
                <td>1.2. Bilang ng mga buntis na finollow-up ng komadrona</td>
                <td>{{ $bhwData->last()->followed_up_pregnant_women ?? '' }}</td>
            </tr>
            <tr>
                <td>1.3. Bilang ng mga buntis na may plano sa panganganak</td>
                <td>{{ DB::table('mother_census')->where('birth_plan', 'Yes')->count() }}</td>
            </tr>
            <tr><td colspan="2" class="section-title">2. Post – Natal Care</td></tr>
            <tr>
                <td>2.1. Bilang ng mga bata na bagong panganak</td>
                <td>{{ $bhwData->last()->home_births ?? '' }}</td>
            </tr>
            <tr>
                <td>2.2. Bilang ng bata na Newborn Screening</td>
                <td>{{ $bhwData->last()->newborn_screened ?? '' }}</td>
            </tr>
            <tr>
                <td>2.3. Bilang ng nanganak sa bahay</td>
                <td>{{ $bhwData->last()->home_births ?? '' }}</td>
            </tr>
            <tr>
                <td>2.4. Bilang ng nanganak sa clinic</td>
                <td>{{ $bhwData->last()->clinic_births ?? '' }}</td>
            </tr>
            <tr>
                <td>2.5. Bilang ng nanganak sa hospital</td>
                <td>{{ $bhwData->last()->hospital_births ?? '' }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">3. Child Care</td></tr>
            <tr>
                <td>3.1. Bilang ng mga bata na nabakunahan BCG</td>
                <td>{{ DB::table('child_censuses')->whereJsonContains('vaccines', 'BCG')->count() }}</td>
            </tr>
            <tr>
                <td>3.2. Bilang ng mga bata pinollow-up para bakunahan (0-11)</td>
                <td>{{ $bhwData->last()->followed_up_for_vaccination ?? '' }}</td>
            </tr>
            <tr>
                <td>3.3. Bilang ng mga bata na nabigyan ng Vit.A (6-72 mos. Old)</td>
                <td>{{ DB::table('child_censuses')->whereJsonContains('vaccines', 'VitaminA')->count() }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">4. FAMILY PLANNING</td></tr>
            <tr>
                <td>4.1. Bilang ng nanay na hindi nagpaplanong pamilya</td>
                <td>{{ DB::table('mother_census')->where('family_planning', 'NO')->count() }}</td>
            </tr>
            <tr>
                <td>4.2. Bilang ng nanay at mga asawa na may plano ng pamilya</td>
                <td>{{ DB::table('mother_census')->where('family_planning', 'Yes')->count() }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">5. NATIONAL TUBERCULOSIS CONTROL PROGRAM</td></tr>
            <tr>
                <td>5.1. Bilang ng pasyente na may sintomas ng TB</td>
                <td>{{ DB::table('mother_census')->where('tb_symptoms', 'Yes')->count() }}</td>
            </tr>
            <tr>
                <td>5.2. Bilang ng pasyenteng nakunan ng plema</td>
                <td>{{ $bhwData->last()->sputum_collected ?? '' }}</td>
            </tr>
            <tr>
                <td>5.3. Bilang ng pasyente na may positive sputum</td>
                <td>{{ DB::table('mother_census')->where('sputum_result', 'Positive')->count() }}</td>
            </tr>
            <tr>
                <td>5.4. Bilang ng pasyente na may TB na may Treatment Partner</td>
                <td>{{ DB::table('mother_census')->where('tb_treatment_partner', 'Yes')->count() }}</td>
            </tr>
            <tr>
                <td>5.5. Bilang ng pasyente na pina-follow up</td>
                <td>{{ $bhwData->last()->followed_up_patients ?? '' }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">6. CARDIOVASCULAR TUBERCULOSIS CONTROL PROGRAM</td></tr>
            <tr>
                <td>6.1. Bilang ng pasyente na mataas ang presyon</td>
                <td>{{ DB::table('mother_census')->where('hypertension_experience', 'Yes')->count() }}</td>
            </tr>
            <tr>
                <td>6.2. Bilang ng pasyente na pinollow-up</td>
                <td>{{ $bhwData->last()->followed_up_patient ?? '' }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">7. ENVIRONMENTAL SANITATION</td></tr>
            <tr>
                <td>7.1. Bilang ng bahay na may palikuran</td>
                <td>{{ DB::table('mother_census')->where('own_toilet', 'Yes')->count() }}</td>
            </tr>
            <tr>
                <td>7.2. Bilang ng bahay na walang palikuran</td>
                <td>{{ DB::table('mother_census')->where('own_toilet', 'No')->count() }}</td>
            </tr>
            <tr>
                <td>7.3. Bilang ng bahay na may pinagkukunan ng malinis na tubig</td>
                <td>{{ DB::table('mother_census')->where('clean_water_source', 'Yes')->count() }}</td>
            </tr>
            <tr>
                <td>7.4. Bilang ng bahay na walang pinagkukunan ng malinis na tubig</td>
                <td>{{ DB::table('mother_census')->where('clean_water_source', 'No')->count() }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">8. CLINIC DUTY: (BHS/RHU) TO ASSIST RHM - bilang ng duty sa loob ng isang (1) buwan</td></tr>
            <tr>
                <td>MBHW - Federation Meeting (Bilang ng dalo sa Pambayang Pagpupulong ng mga BHW)</td>
                <td>{{ $bhwData->last()->mbhw_meeting_attendance ?? '' }}</td>
            </tr>
            <tr>
                <td>PFBHW - Federation Meeting (Bilang ng dalo sa Panlalawigang Pagpupulong ng mga Pangulo)</td>
                <td>{{ $bhwData->last()->pfbhw_meeting_attendance ?? '' }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">9. REFERRAL</td></tr>
            <tr>
                <td>9.1. Mga pasyente na dinala sa BHS/Hospital at MAY referral</td>
                <td>{{ $bhwData->last()->referred_patients ?? '' }}</td>
            </tr>
            <tr>
                <td>9.2. Mga pasyente na dinala sa BHS/Hospital at WALANG referral</td>
                <td>{{ $bhwData->last()->non_referred_patients ?? '' }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">10. PROJECT</td></tr>
            <tr>
                <td>10.1. Daming pamilya na nasurvey sa barangay</td>
                <td>{{ $bhwData->last()->surveyed_families ?? '' }}</td>
            </tr>
            <tr>
                <td>10.2. Pagtitinda ng iodized salt sa inyong household</td>
                <td>{{ $bhwData->last()->iodized_salt_sold ?? '' }}</td>
            </tr>
            <tr>
                <td>10.3. Dengue Barangay Brigade/Larva Survey bilang ng malinis na tirahan ng lamok</td>
                <td>{{ $bhwData->last()->clean_larvae_habitats ?? '' }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">11. BIRTHS COVERED</td></tr>
            <tr>
                <td>11.1 Kabuuang ipinanganak sa household covered</td>
                <td>{{ $bhwData->last()->total_births_in_area ?? '' }}</td>
            </tr>

            <tr><td colspan="2" class="section-title">12. DEATH COVERED</td></tr>
            <tr>
                <td>12.1 Kabuuang namatay sa household covered</td>
                <td>{{ $bhwData->last()->total_deaths_in_area ?? '' }}</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" >
                    <div class="d-flex justify-content-between">
                        <div class="footer-text border-0">
                            Ginawa at Isinumite ni:
                            <div class="ms-5 mb-4 text-center">
                                <br>________________________________<br>BHW-Pangalan at Lagda 
                            </div>
                            Pinagtibay nina:
                            <div class="ms-5 mt-4 text-center">
                            ________________________________ <br>City/Municipal Health Officer 
                            </div>
                        </div>
                        <div class="footer-text border-0">
                            Inaprobahan ni:
                            <div class="ms-5 mt-4 text-center">
                            ________________________________<br>RHM-Pangalan at Lagda  
                            </div>
                            <div class="ms-5 mt-4 text-center">
                            ________________________________<br>BHW-Provincial Coordinator
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </tfoot>
    </table>
</div>




        </div>
    </section>
</main> 

@include('bhw.partials.__footer')