@include('bhw.partials.__header')
@include('admin.partials.__nav')

<style>
    .services button {
        border-radius: 20px;
    }
    .services button:hover {
        background-color: grey;
        color: white;
    }

</style>

<main id="main" class="main">
    <div class="pagetitle mb-5">
        <h1 class="fs-3"><strong>Services</strong></h1>
    </div>
    <section class="section services">
        <div class="d-flex flex-column bg-white p-6 rounded-lg shadow-lg w-96 text-center rounded rounded-4" style="height: auto; padding: 50px 0;">
            <h1 class="text-2xl font-bold mb-4"><strong>Service List</strong></h1>
            <div class="d-flex flex-column align-self-center space-y-3 w-75">
                <button onclick="window.location.href='{{ route('bhw.child') }}'" class="w-full text-gray-800 py-3 mb-3 border border-gray-300 hover:bg-gray-200">CENSUS</button>
                <button onclick="window.location.href='{{ route('bhw.mother-census') }}'" class="w-full text-gray-800 py-3 mb-3 border border-gray-300 hover:bg-gray-200">MATERNAL CARE</button>
                <button onclick="window.location.href='{{ route('bhw.familyplanning') }}'" class="w-full text-gray-800 py-3 mb-3 border border-gray-300 hover:bg-gray-200">FAMILY PLANNING</button>
                <button onclick="window.location.href='{{ route('bhw.wreproductiveage.index') }}'" class="w-full text-gray-800 py-3 mb-3 border border-gray-300 hover:bg-gray-200">WOMAN IN REPRODUCTIVE AGE</button>
                <button onclick="window.location.href='{{ route('bhw.child') }}'" class="w-full text-gray-800 py-3 mb-3 border border-gray-300 hover:bg-gray-200">IMMUNIZATION</button>
                <button onclick="window.location.href='{{ route('bhw.deworming.index') }}'" class="w-full text-gray-800 py-3 mb-3 border border-gray-300 hover:bg-gray-200">DEWORMING</button>
                <button onclick="window.location.href='{{ route('bhw.deworming.index') }}'" class="w-full text-gray-800 py-3 mb-3 border border-gray-300 hover:bg-gray-200">OVERALL MONTHLY REPORT</button>
            </div>
        </div>
    </section>
</main>

@include('bhw.partials.__footer')