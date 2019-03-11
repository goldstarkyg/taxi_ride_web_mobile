 <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 3.1.1
        </div>
        <strong>Copyright &copy; 2015-2016 <a href="http://v1technologies.co.uk/" target="_blank">V1 Technologies</a>.</strong> All rights reserved.
      </footer>
	  <script src="<?php echo base_url();?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>

	  <script>
   $(document).ready(function(){

       var url = window.location.href;
      $('.sidebar-menu li a').each(function()
      {
        var li_url=$(this).attr('href');
          if(li_url==url)
          {
           $(this).parents('li').addClass('active');
           }
        });


   });

   </script>
<!--<footer id="footer-bar" class="row">-->
<!--    <p id="footer-copyright" class="col-xs-12">-->
<!--        www.techaheadcorp.com-->
<!--    </p>-->
<!--</footer>-->