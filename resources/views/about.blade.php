<x-app-layout>
    <div class="pt-24">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
            <h1 class="my-4 text-5xl font-bold leading-tight">
                Our Concept & Philosophy
            </h1>
        <p class="leading-normal text-2xl mb-8">
            LMJZ Bakery breads are made fresh from scratch using the highest quality ingredients. In addition to our pandesal, we also make soft-crusted sandwich breads, specialty breads and other baked treats like muffins and ensaymadas. We encourage a more healthy and natural lifestyle, having it as one of our company values.
        </p>
        </div>
        <!--Right Col-->
        <div class="w-full md:w-3/5 py-6 text-center">
            <img class="w-full md:w-4/5 z-50" src="{{ asset('img/bread_about1.png') }}" />
        </div>
        </div>
    </div>
    <div class="pt-24">
        <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="w-full md:w-3/5 py-6 text-center">
            <img class="w-full md:w-4/5 z-50" src="{{ asset('img/bread_about2.png') }}" />
        </div>
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
            <h1 class="my-4 text-5xl font-bold leading-tight">
                Our Product Line-Up
            </h1>
            <!--Right Col-->
            <p class="leading-normal text-2xl mb-8">
                We have a wide range of breads, from the most basic all-time favorite Filipino Pandesal, to other flavored and speciality breads. Click <a href="{{route('products')}}" class="font-bold">here</a> to view our menu.
            </p>
        </div>
        </div>
    </div>
</x-app-layout>