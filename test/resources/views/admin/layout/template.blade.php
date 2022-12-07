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
        @include('admin.partials.adminSidebar')
        <!-- End of Sidebar -->
         <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                 <!-- Topbar -->
                 @include('admin.partials.adminNav')
                 {{-- End of Topbar --}}
                 <!-- Begin Page Content -->
                 @yield('adminContent')

                

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
                <form method="POST" action="{{ route('admin.logout') }}">
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