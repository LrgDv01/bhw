<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BHW Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">BHW Report Form</h2>
        <form action="{{ route('bhwform.store') }}" method="POST">
        <button type="button" class="btn btn-secondary px-4" onclick="window.history.back()">Back</button>
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label class="form-label">Bilang ng mga buntis na finollow-up ng komadrona</label>
                    <input type="number" class="form-control" name="followed_up_pregnant_women" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bilang ng mga bata na bagong panganak</label>
                    <input type="number" class="form-control" name="newborn_babies" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Bilang ng bata na Newborn Screening</label>
                    <input type="number" class="form-control" name="newborn_screened" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bilang ng nanganak sa bahay</label>
                    <input type="number" class="form-control" name="home_births" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Bilang ng nanganak sa clinic</label>
                    <input type="number" class="form-control" name="clinic_births" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bilang ng nanganak sa hospital</label>
                    <input type="number" class="form-control" name="hospital_births" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Bilang ng mga pasyenteng nakunan ng plema</label>
                    <input type="number" class="form-control" name="sputum_collected" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bilang ng mga buntis na finollow-up para bakunahan</label>
                    <input type="number" class="form-control" name="followed_up_for_vaccination" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Bilang ng mga pasyenteng finollow-up</label>
                    <input type="number" class="form-control" name="followed_up_patients" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Bilang ng mga pasyenteng finollow-up</label>
                    <input type="number" class="form-control" name="followed_up_patient" required>
                </div>
                
                <div class="col-md-6">
                    <label class="form-label">MBHW-Federation Meeting Attendance</label>
                    <input type="number" class="form-control" name="mbhw_meeting_attendance" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">PFBHW-Federation Meeting Attendance</label>
                    <input type="number" class="form-control" name="pfbhw_meeting_attendance" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Mga pasyente na dinala sa BHS/Hospital na MAY referral</label>
                    <input type="number" class="form-control" name="referred_patients" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Mga pasyente na dinala sa BHS/Hospital na WALANG referral</label>
                    <input type="number" class="form-control" name="non_referred_patients" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Daming pamilya na nasurvay sa barangay</label>
                    <input type="number" class="form-control" name="surveyed_families" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Pagtitinda ng iodised salt sa household/catchment areas</label>
                    <input type="number" class="form-control" name="iodized_salt_sold" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Dengue Barangay Brigade/Larva Survey bilang ng malinis na tirahan ng lamok</label>
                    <input type="number" class="form-control" name="clean_larvae_habitats" required>
                </div>
            </div>
            
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Kabuuang ipinanganak sa household covered</label>
                    <input type="number" class="form-control" name="total_births_in_area" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kabuuang namatay sa household covered</label>
                    <input type="number" class="form-control" name="total_deaths_in_area" required>
                </div>
            </div>
            
            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary">Submit Report</button>
            </div>
        </form>
    </div>
</body>
</html>
