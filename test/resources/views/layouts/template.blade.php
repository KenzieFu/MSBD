<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

        <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
        

    <!-- Custom styles for this template-->
    <link href="/css/admin/sb-admin-2.min.css" rel="stylesheet">
  



 
    @vite('resources/css/app.css')
</head>

<body id="page-top" class="m-0 p-0"> 

    <div id="wrapper">
        <!-- Sidebar -->
        @include('partials.adminSidebar')
        <!-- End of Sidebar -->
         <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                 <!-- Topbar -->
                 @include('partials.adminNav')
                 {{-- End of Topbar --}}
                 @if (session()->has('success'))
<div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3" role="alert">
    <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
    <p>{{ session('success') }}</p>
  </div>
@endif
                 <!-- Begin Page Content -->
                 @yield('siswaContent')

                

            </div>
        </div>



    </div>

    

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                    <button class="btn btn-secondary bg-red-500 text-white " type="button" data-dismiss="modal">Cancel</button>
                    
                        @csrf
                        <button class="btn btn-primary bg-green-500 text-white" type="submit">Logout</button>
                    
                </div>
            </form>
            </div>
        </div>
    </div>


   






 

   
   <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/admin/sb-admin-2.min.js"></script>

     <!-- Page level plugins -->
     <script src="vendor/chart.js/Chart.min.js"></script>

     <!-- Page level custom scripts -->
     <script src="js/demo/chart-area-demo.js"></script>
     <script src="js/demo/chart-pie-demo.js"></script>
 


     <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
 {{--     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> --}}
 
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
 
     <script >
         $(".mydatatable").DataTable();
     </script>



</body>

</html>