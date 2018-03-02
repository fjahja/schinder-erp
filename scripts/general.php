<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="bower_components/Chart.js/Chart.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        // ajax checkers
        window.setInterval(function(){

            if($('.aips').length){
                $('.aips').each(function(){
                    // running times
                    var thiscl = $(this);
                    var Form = {};
                    Form.starttime = $(this).attr('data-load');
                    $.post( "crud/contribution.php?v=ajax_measure", { Form })
                        .done(function( data ) {
                            thiscl.html(data);
                    });
                });
            }
        }, 1000);

        // Javascript to enable link to tab
        var url = document.location.toString();
        if (url.match('#')) {
            $('.nav-tabs a[href="#' + url.split('#')[1] + '"]').tab('show');
        } 
        // Change hash for page-reload
        $('.nav-tabs a').on('shown.bs.tab', function (e) {
            window.location.hash = e.target.hash;
        })

        $('.modal').on('shown.bs.modal', function () {
            $(this).find('#focusfirst').focus()
        });

        $('.select2').select2();

        // checkbox toggle logic
        $('body').on("click", '.checkToggle', function(event) {
            event.preventDefault();

            var thiscl = $(this);
            var target = thiscl.attr('data-target');

            // checkall section
            if(thiscl.hasClass('checkall')){
                $('.'+target).prop('checked', true);
            }

            // checkall section
            if(thiscl.hasClass('uncheckall')){
                $('.'+target).prop('checked', false);
            }

            // var thischeckbox = thiscl.children('input');
            // var datagroup = thiscl.attr('data-group');

            // if (thischeckbox.is(':checked')) {
            //     $('.groupinp'+datagroup).prop('checked', true);
            // } else {
            //     $('.groupinp'+datagroup).prop('checked', false);
            // }
        });
        
        // begin custom scripts
        // Global scripts
        $('body').on('click','a[href$="#"]', function(event){
          event.preventDefault();
        });

        $('.alert-dismissible').delay(5000).fadeOut();

        // general toast header
        $('body').on("click", ".toast-header", function(event) {

            var wrapper = $('.toast-wrapper');
            if(wrapper.hasClass('closed')){
                wrapper.removeClass('closed');
            } else {
                wrapper.addClass('closed');
            }
        });

        //ajax stop contribution from toast
        $('body').on("click", '.toast-stop', function(event) {

            var thiscl = $(this);
            var Form = {};
            Form.contribution_id = thiscl.attr('data-stop');
            var loadertoast = thiscl.parents('tr').find('.loader.toast');

            loadertoast.removeClass('hidden');

            $.post( "crud/contribution.php?v=ajax_stop", { Form })
                .done(function( data ) {
                    loadertoast.addClass('hidden');
                    thiscl.parents('tr').addClass('warning').find('.timer-stats').html('Completed');
                    thiscl.remove();
                    location = location + '&toast=1';
                    window.setTimeout(function(){window.location.reload()}, 2000);
            });
        });



    });
</script>