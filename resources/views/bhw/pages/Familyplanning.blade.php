@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Planning</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Family Planning Form</h1>
        <form action="{{ route('bhw.familyplanning.store') }}" method="POST">
            @csrf
            
            <label class="block font-semibold">Family Serial No.:</label>
            <input type="text" name="serial_no" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">Name:</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">Complete Address:</label>
            <input type="text" name="address" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">Age/Date of Birth:</label>
            <input type="date" name="age_dob" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">SE Status:</label>
            <select name="se_status" class="w-full border rounded-lg p-2 mb-3">
                <option value="1">NHTS</option>
                <option value="2">Non NHTS</option>
            </select>

            <label class="block font-semibold">Type of Client:</label>
            <select name="client_type" class="w-full border rounded-lg p-2 mb-3">
                <option value="NA">New Acceptors</option>
                <option value="CU">Current Users</option>
                <option value="OA">Other Acceptors</option>
                <option value="CU-CM">Changing Methods</option>
                <option value="CU-CC">Changing Clinic</option>
                <option value="CU-RS">Restarter</option>
            </select>

            <label class="block font-semibold">Source:</label>
            <select name="source" class="w-full border rounded-lg p-2 mb-3">
                <option value="Public">Public</option>
                <option value="Private">Private</option>
            </select>

            <label class="block font-semibold">Previous Method:</label>
            <select name="previous_method" class="w-full border rounded-lg p-2 mb-3">
                <option value="NONE">None or New Acceptor</option>
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

            <label class="block font-semibold">Follow-Up Visits - Month:</label>
            <input type="text" name="followup_month" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">Schedule Date:</label>
            <input type="date" name="schedule_date" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">Actual Date:</label>
            <input type="date" name="actual_date" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">Drop Out Date:</label>
            <input type="date" name="dropout_date" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">Drop Out Reason:</label>
            <select name="dropout_reason" class="w-full border rounded-lg p-2 mb-3">
                <option value="A">Pregnant</option>
                <option value="B">Desire to become pregnant</option>
                <option value="C">Medical complications</option>
                <option value="D">Fear of side effects</option>
                <option value="E">Changed Clinic</option>
                <option value="F">Husband disapproves</option>
                <option value="G">Menopause</option>
                <option value="H">Lost or moved out of the area</option>
                <option value="I">Failed to get supply</option>
                <option value="J">Change Method</option>
                <option value="K">Underwent Hysterectomy</option>
                <option value="L">Underwent Bilateral Salpingo-oophorectomy</option>
                <option value="M">No FP Commodity</option>
                <option value="N">Unknown</option>
                <option value="O">Age out for BTL</option>
                <option value="Q">Mother has a menstruation or not amenorrheic within 6 months</option>
                <option value="R">No longer practicing fully/exclusively breastfeeding</option>
                <option value="S">Baby is more than six (6) months old</option>
            </select>
            
            <div class="flex justify-between mt-4">
                <a href="{{ route('bhw.serv') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-200">Back</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
