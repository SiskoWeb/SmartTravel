<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/ea3542be0c.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="relative min-h-screen flex ">
        <div class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
            <div style="background-image: url(assets/auth/bg.jpg)" class="sm:w-1/2 xl:w-2/5 h-full hidden md:flex flex-auto items-center justify-start p-10 overflow-hidden  text-white bg-no-repeat bg-cover relative">


            </div>
            <div class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white ">
                <div class="max-w-md w-full space-y-8">
                    <div class="text-center flex flex-col justify-center items-center">
                        <img class="w-20 h-auto " src="assets/logo.png" alt="traveklsmart">
                        <h2 class="mt-6 text-3xl font-bold text-gray-900">
                            Welcome to TravelSmart!
                        </h2>
                        <p class="mt-2 text-sm text-gray-500">Please sign in to your account</p>
                    </div>

                    <form class="mt-8 space-y-6" action="#" method="POST">
                        <input type="hidden" name="remember" value="true">
                        <div class="relative">
                            <div class="absolute right-3 mt-4"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
                            <input class=" w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-green-500" type="" placeholder="mail@gmail.com" value="">
                        </div>
                        <div class="mt-8 content-center">
                            <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                                Password
                            </label>
                            <input class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-green-500" type="" placeholder="Enter your password" value="">
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center bg-gradient-to-r from-green-600 to-green-600  hover:bg-green-to-l hover:from-green-600 hover:to-green-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                                Sign in
                            </button>
                        </div>
                        <p class="flex flex-col items-center justify-center mt-10 text-center text-md text-gray-500">
                            <span>Don't have an account?</span>
                            <a href="#" class="text-green-600 hover:text-green-600 no-underline hover:underline cursor-pointer transition ease-in duration-300">Sign
                                up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>