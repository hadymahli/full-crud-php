    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- asset plugin datatables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- load fontawesome with cnd-->
     <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

     <!-- load cekeditor cdn -->
   <script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>
<script src="assets/ckfinder/ckfinder.js"></script>

<script>
    CKEDITOR.replace('alamat', {
        height: '400px',
        filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
        filebrowserImageBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Images',
        filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        filebrowserImageUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
    });
</script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    </body>

    </html>