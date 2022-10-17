<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Document</title>
</head>
<body class="bg-aqua">
    <header class="p-5 mb-10">
        <h1 class="text-3xl text-center font-bold text-white">Sistem Informasi Akademik Sekolah (SMP)</h1>
    </header>
    <main class=" h-full w-full  flex flex-col justify-center items-center">
        <h1 class="text-2xl mb-3">Masuk Sebagai</h1>
        <div class="flex mt-5 gap-5    ">
         
            <a class="w-[200px] h-[200px] hover:brightness-50 bg-white block rounded-lg p-3" href="/login"><img src="img/student.png" alt="">
          </a>
            <a class="w-[200px] h-[200px] hover:brightness-50 bg-white block rounded-lg p-3" href="{{ route('teacher.login') }}"><img src="img/teacher.png" alt=""></a>
            <a class="w-[200px] h-[200px] hover:brightness-50 bg-white block rounded-lg p-3" href="{{ route('admin.login') }}"><img src="img/administrator.png" alt=""></a>
            
        </div>

    </main>
    
  
</body>
</html>