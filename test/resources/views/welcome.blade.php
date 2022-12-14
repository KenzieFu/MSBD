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
         
            <a class="w-[200px] relative h-[200px] group    bg-white block rounded-lg p-3" href="/login"><img class="group-hover:brightness-50" src="img/student.png" alt="">
                <div class=" group-hover:brightness-100 group-hover:visible flex justify-center items-center invisible">
                    <div class="absolute  text-xl text-white  font-bold text-center bottom-0">
                        Siswa
                        </div>
                    </div>
                
          </a>
            <a class="w-[200px] h-[200px] relative group  bg-white block rounded-lg p-3" href="{{ route('teacher.login') }}"><img class="group-hover:brightness-50" src="img/teacher.png" alt="">
                <div class="group-hover:brightness-100 group-hover:visible flex justify-center items-center invisible">
                    <div class="absolute  text-xl text-white  font-bold text-center bottom-0">
                        Guru
                    </div>
            </div>
            </a>


            <a class="w-[200px] h-[200px] relative group  bg-white block rounded-lg p-3" href="{{ route('admin.login') }}"><img class="group-hover:brightness-50" src="img/administrator.png"  alt="">
                <div class="group-hover:brightness-100 group-hover:visible flex justify-center items-center invisible">
                    <div class="absolute  text-xl text-white  font-bold text-center bottom-0">
                        Admin
                    </div>
            </div>
        </a>
            
        </div>

    </main>
    
  
</body>
</html>
{{-- tes --}}