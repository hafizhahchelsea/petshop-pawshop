<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login - Pet Shop</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="m-0 p-0 font-sans bg-[#EDEAFF]">
  <div class="flex h-screen justify-center items-center">
    <div class="flex w-[1000px] h-[650px] bg-white rounded-[15px] shadow-lg overflow-hidden">
      
      <!-- LEFT IMAGE -->
      <div class="flex-1 bg-white flex justify-center items-center p-5">
        <img 
          src="https://i.pinimg.com/1200x/95/87/71/9587712cf4823ec32d1dc44c5fd99915.jpg" 
          alt="Pet Shop" 
          class="w-full max-w-[350px] rounded-lg shadow-md"
        >
      </div>

      <!-- RIGHT LOGIN FORM -->
      <div class="flex-1 bg-[#BCA7F4] p-10 flex flex-col justify-center">
        <h2 class="text-white text-3xl font-bold mb-2">Admin Login</h2>
        <p class="text-gray-100 mb-5">Welcome back, Admin!</p>

        <!-- Session Error -->
        @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif

        <!-- Validation Errors -->
        @if ($errors->any())
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
              <ul class="list-disc ml-4">
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
            @csrf

            <div>
              <input 
                  type="email" 
                  name="email"
                  placeholder="Email Admin" 
                  required 
                  class="w-full p-3 rounded-lg border-none focus:ring-2 focus:ring-[#7A4EF5] outline-none"
              >
            </div>

            <div>
              <input 
                  type="password" 
                  name="password"
                  placeholder="Password" 
                  required 
                  class="w-full p-3 rounded-lg border-none focus:ring-2 focus:ring-[#7A4EF5] outline-none"
              >
            </div>

            <button 
                type="submit" 
                class="w-full p-3 bg-[#7A4EF5] text-white rounded-lg font-bold hover:bg-[#5f36d9] transition"
            >
              Log in
            </button>
        </form>

      </div>
    </div>
  </div>
</body>
</html>
