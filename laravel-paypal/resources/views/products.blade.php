<!DOCTYPE html>
<html lang="en">
<head> 
    <title>Youtebe Demo - ItSolutionStuff.com</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <h1 class="font-bold text-gray-800 mb-8 text-4xl">Products</h1>
        
        

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white rounded-lg shadow p-4 flex flex-col items-center">
                <img src="https://plus.unsplash.com/premium_photo-1661963063875-7f131e02bf75?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Images" class="w-8 h-8 object-cover rounded-full mb-4">
                <h2 class="text-lg font-semibold text-gray-700">Product </h2>
                <p class="text-blue-600 font-bold text-md mb-2">100</p>
                <a href="#" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-md">View</a>
            </div>
        </div>
    </div>
</body>
</html>