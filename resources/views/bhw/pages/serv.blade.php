@include('bhw.partials.__header')
@include('bhw.partials.__nav')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96 text-center">
        <h1 class="text-2xl font-bold mb-4">Services</h1>
        <div class="space-y-3">
            <button onclick="window.location.href='{{ route('bhw.child') }}'" class="w-full text-gray-800 py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-200">Census</button>
            <button onclick="window.location.href='{{ route('bhw.services') }}'" class="w-full text-gray-800 py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-200">Maternal Care</button>
            <button onclick="window.location.href='{{ route('bhw.familyplanning') }}'" class="w-full text-gray-800 py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-200">Family Planning</button>
            <button onclick="window.location.href='{{ route('bhw.wreproductiveage.index') }}'" class="w-full text-gray-800 py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-200">Woman in Reproductive Age</button>
            <button onclick="window.location.href='{{ route('bhw.child') }}'" class="w-full text-gray-800 py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-200">Immunization</button>
            <button onclick="window.location.href='{{ route('bhw.deworming.index') }}'" class="w-full text-gray-800 py-2 px-4 rounded-lg border border-gray-300 hover:bg-gray-200">Deworming</button>
        </div>
    </div>
</body>
</html>
