<x-app-layout>
  <div class="pt-24">
      <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
        <!--Left Col-->
        <div class="flex flex-col w-full md:w-2/5 justify-center items-start text-center md:text-left">
          <h1 class="my-4 text-5xl font-bold leading-tight">
            Made Fresh For You!
          </h1>
          <p class="leading-normal text-2xl mb-8">
            Give the gift of good bread and pastries to the special persons in your life. Click here to find our premium breads!
          </p>
          <a class="btn mx-auto lg:mx-0 hover:underline bg-yellow-500 text-gray-800 font-bold rounded-full my-6 py-4 px-8 shadow-lg focus:outline-none focus:shadow-outline transform transition hover:scale-105 duration-300 ease-in-out">
            Shop Now
          </a>
        </div>
        <!--Right Col-->
        <div class="w-full md:w-3/5 py-6 text-center">
          <img class="w-full md:w-4/5 z-50" src="{{ asset('img/bread_homepage.png') }}" />
        </div>
      </div>
    </div>
</x-app-layout>
