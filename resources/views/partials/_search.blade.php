<form action="" class="animate-fadeIn">
    <div class="relative border-2 border-gray-100 my-4 mx-8 rounded-lg 
                transform transition-all duration-300 hover:shadow-lg hover:border-blue-200
                animate-slideDown" style="--delay: 200ms">
        <div class="absolute top-4 left-3 animate-slideRight" style="--delay: 400ms">
            <i class="fa fa-search text-gray-400 transition-colors duration-300
                      hover:text-blue-500 cursor-pointer"></i>
        </div>
        <input type="text" 
               name="search" 
               class="text-gray-800 h-14 w-full pl-10 pr-20 rounded-lg
                      transition-all duration-300 ease-in-out
                      focus:ring-2 focus:ring-blue-500 focus:border-transparent
                      hover:border-blue-300"
               placeholder="Napravi pretragu..."
               autocomplete="off" />
        <div class="absolute top-2 right-2 animate-slideLeft" style="--delay: 600ms">
            <button type="submit" 
                    class="h-10 w-20 text-white rounded-lg bg-blue-500
                           transform transition-all duration-300 ease-out
                           hover:bg-blue-600 hover:scale-105 hover:shadow-md
                           focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Pretraga
            </button>
        </div>
    </div>
</form>
<link rel="stylesheet" href="{{ asset('css/search.css') }}">