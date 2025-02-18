@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproductive Age Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
        <h1 class="text-2xl font-bold mb-4 text-center">Reproductive Age Form</h1>
        <form action="{{ route('bhw.wreproductiveage.store') }}" method="POST">
            @csrf
            
            <label class="block font-semibold">Name:</label>
            <input type="text" name="name" class="w-full border rounded-lg p-2 mb-3" required>

            <label class="block font-semibold">Birthday:</label>
            <input type="date" name="birthday" class="w-full border rounded-lg p-2 mb-3" required>

            <label class="block font-semibold">Age:</label>
            <input type="number" name="age" class="w-full border rounded-lg p-2 mb-3" required>

            <label class="block font-semibold">Status:</label>
            <input type="text" name="status" class="w-full border rounded-lg p-2 mb-3">

            <label class="block font-semibold">FP Used:</label>
            <select name="fp_used" class="w-full border rounded-lg p-2 mb-3" required>
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

            <label class="block font-semibold">Address:</label>
            <input type="text" name="address" class="w-full border rounded-lg p-2 mb-3" required>

            <label class="block font-semibold">NHTS:</label>
            <input type="text" name="nhts" class="w-full border rounded-lg p-2 mb-3">

            <div class="flex justify-between mt-4">
                <a href="{{ route('bhw.serv') }}" class="px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-200">Back</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Submit</button>
            </div>
        </form>
    </div>
</body>
</html>
