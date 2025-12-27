 <nav class="bg-white  shadow-md px-4 py-2">
     <div class="flex justify-between items-center">
         <div class="text-2xl text-green-900 hover:bg-gray-100 cursor-pointer rounded-md px-3 py-2 font-medium">
             <a href="/">
                 Quiz System
             </a>
         </div>
         <div class="space-y-1">
             <a class="text-green-900 text-sm hover:bg-gray-100 rounded-md font-medium  px-3 py-2" href="/">Home</a>
             <a class="text-green-900 text-sm hover:bg-gray-100 rounded-md font-medium  px-3 py-2"
                 href="/categories-list">Categories</a>
             @if(session('user_name'))
             <a class="text-green-900 text-sm hover:bg-gray-100 rounded-md font-medium  px-3 py-2"
                 href="/user-details">welcom
                 {{session('user_name')}}</a>
             <a class="text-green-900 text-sm hover:bg-gray-100 rounded-md font-medium  px-3 py-2"
                 href="/user-logout">Logout</a>
             @else

             <a class="text-green-900 text-sm hover:bg-gray-100 rounded-md font-medium px-3 py-2"
                 href="/user-login">Login
             </a>
             <a class="text-green-900 text-sm hover:bg-gray-100 rounded-md font-medium px-3 py-2" href="/user-signup">
                 SignUp</a>
             @endif
         </div>
     </div>

 </nav>
