@include('bhw.partials.__header')
@include('admin.partials.__nav')

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1 class="fs-4"><strong>WOMAN IN REPRODUCTIVE AGE (10-49 YEARS OLD)</strong></h1>
    </div>
    <section class="section family-planning">

            <h1 class="text-center fs-3"><strong>Details Form</strong></h1>
            <form action="{{ route('bhw.wreproductiveage.store') }}" method="POST">
                @csrf
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-6 mb-3 text-black tex-center">
                        <label for="name" class="form-label fw-bold">Name:</label>
                        <input type="text" name="name" class="form-control w-full border rounded-lg p-2 mb-3"
                            placeholder="Name" required autocomplete="name">

                        <label for="birthday" class="form-label fw-bold">Birthday:</label>
                        <input type="date" name="birthday" class="form-control w-full border rounded-lg p-2 mb-3" id="birthday" 
                            placeholder="Birthday" required autocomplete="birthday">

                        <label for="age"class="form-label fw-bold">Age:</label>
                        <input type="number" name="age" class="form-control w-full border rounded-lg p-2 mb-3" id="age" 
                            placeholder="Age" required autocomplete="age" readonly>

                        <label for="status" class="form-label fw-bold">Status:</label>
                        <select name="status" class="form-select w-full border rounded-lg p-2 mb-3">
                            <option value="" hidden>Select Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Widowed">Widowed</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Annulled">Annulled</option>
                        </select>
                        <label for="fp_used" class="form-label fw-bold">FP Used:</label>
                        <select name="fp_used" class="form-select w-full border rounded-lg p-2 mb-3">
                            <option value="" hidden>Select Used</option>
                            <option value="NONE">None</option>
                            <option value="BTL">Bilateral Tubal Ligation</option>
                            <option value="NSV">No-Scalpel Vasectomy</option>
                            <option value="CON">Condom</option>
                            <option value="Pills-POP">Progestin Only Pills</option>
                            <option value="Pills-COC">Combined Oral Contraceptives</option>
                            <option value="INJ">DMPA or CIC</option>
                            <option value="IMP">Single rod sub-thermal Implant</option>
                            <option value="IUD-I">IUD Interval</option>
                            <option value="IUD-PP">IUD Postpartum</option>
                            <option value="NFP-LAM">Lactational Amenorrhea Method</option>
                            <option value="NFP-BBT">Basal Body Temperature</option>
                            <option value="NFP-CMM">Cervical Mucus Method</option>
                            <option value="NFP-STM">Symptothermal Method</option>
                            <option value="NFP-SDM">Standard Days Method</option>
                        </select>

                        <label for="address" class="form-label fw-bold">Address:</label>
                        <input type="text" name="address" class="form-control w-full border rounded-lg p-2 mb-3" 
                            placeholder="Address" required autocomplete="address">

                        <label for="nhts" class="form-label fw-bold">NHTS:</label>
                        <input type="text" name="nhts" class="form-control w-full border rounded-lg p-2 mb-3"
                            placeholder="NHTS" required autocomplete="nhts">

                        <div class="text-center d-flex justify-content-end">
                            <button type="submit" class="btn btn-success px-5 py-2 fw-bold rounded rounded-3">Submit</button>
                        </div>
                        
                       {{-- <a href="{{ route('bhw.services') }}" class="btn btn-outline-dark fw-bold">Back</a>--}}
                    </div>
                    </div>
                </div>
                
            </form>
        </div>
    </section>
</main>
@include('bhw.partials.__footer')

<script>
    const birthdayInput = document.getElementById('birthday');
    const ageInput = document.getElementById('age');
    function calculateAge(birthday) {
        const birthDate = new Date(birthday);
        const today = new Date();
        let age = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        return age;
    }
    birthdayInput.addEventListener('change', function() {
        const birthdayValue = this.value;
        if (birthdayValue) {
            const age = calculateAge(birthdayValue);
            ageInput.value = age >= 0 ? age : 0; 
        } else {
            ageInput.value = ''; 
        }
    });
</script>