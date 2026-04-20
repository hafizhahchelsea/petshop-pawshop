<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pet Shop - Sign Up</title>
  @vite('resources/css/app.css')
</head>
<body class="m-0 p-0 font-sans bg-[#EDEAFF]">
  <div class="flex h-screen justify-center items-center">
    <div class="flex w-[1000px] h-[650px] bg-white rounded-2xl shadow-lg overflow-hidden">
      
      <!-- Bagian kiri -->
      <div class="flex-1 bg-white flex justify-center items-center p-5">
        <img src="https://i.pinimg.com/1200x/95/87/71/9587712cf4823ec32d1dc44c5fd99915.jpg" 
             alt="Pet Shop" 
             class="w-full max-w-[350px] rounded-md">
      </div>

      <!-- Bagian kanan -->
      <div class="flex-1 bg-[#BCA7F4] p-10 flex flex-col justify-center">
        <h2 class="text-white mb-2 text-2xl font-semibold">Sign up</h2>
        <p class="text-gray-100 mb-5">Hello, Welcome!</p>

        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
          @csrf
          <div>
             <input type="text" name="username" placeholder="Username" required
                   class="w-full px-4 py-3 rounded-lg bg-white text-black shadow-sm focus:ring-2 focus:ring-purple-500 outline-none">
          </div>
          <div>
              <input type="email" name="email" placeholder="Email" required
                   class="w-full px-4 py-3 rounded-lg bg-white text-black shadow-sm focus:ring-2 focus:ring-purple-500 outline-none">
          </div>
          <div>
              <input type="password" name="password" placeholder="Password" required
                   class="w-full px-4 py-3 rounded-lg bg-white text-black shadow-sm focus:ring-2 focus:ring-purple-500 outline-none">
          </div>
          <div>
          <input type="password" name="password_confirmation" placeholder="Confirm Password" required 
               class="w-full px-4 py-3 rounded-lg bg-white text-black shadow-sm focus:ring-2 focus:ring-purple-500 outline-none">
        </div>
          <button type="submit" 
                  class="w-full px-4 py-3 bg-[#7A4EF5] text-white rounded-lg font-bold hover:bg-[#5f36d9] transition">
            Sign up
          </button>
        </form>

        <div class="text-center mt-4">
          <p class="text-sm text-white">
            Sudah memiliki akun?
            <a href="/login" class="underline font-semibold">Login disini</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
