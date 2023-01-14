@props(['listing'])
<x-card>
    <section>
    <div class="flex top-0 left-0 w-full h-full p-black text-black py-2 px-5"
         style="background-image: url('images/laravel-logo.png')"
    >
    
        <img
            class="hidden w-48 mr-6 md:block  width-100% height-auto "
            src="{{$listing->logo ? asset('storage/' . $listing->logo) : asset('/images/no-image.png')}}"
            alt=""/>
        <a href="/listings/{{$listing->id}}">
        <div class="text-black py-5 px-4 ">
            <h3 class="hover:text-black-600 text-1.5xl">
                {{-- change header from hard coded to dynamic --}}
                {{ $listing->title }} 
            </h3>
            <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
            <x-listing-tags :tagsCsv="$listing->tags"/>
            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i>
                {{ $listing->location }}
            </div>
        </div>
       </a>
    </div>
    </section>
</x-card>