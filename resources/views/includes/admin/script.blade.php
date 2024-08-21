 <!-- Vendor JS Files -->
 <script src="{{asset('assets2/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{asset('assets2/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets2/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{asset('assets2/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{asset('assets2/vendor/quill/quill.js')}}"></script>
  <script src="{{asset('assets2/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{asset('assets2/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{asset('assets2/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets2/js/main.js')}}"></script>


  <script>
    var quill = new Quill('#editor', {
        theme: 'snow'  // 'snow' is the default theme
    });

    // Update hidden textarea with Quill's content
    quill.on('text-change', function() {
        var html = quill.root.innerHTML;
        document.getElementById('postContent').value = html;
    });
</script>
