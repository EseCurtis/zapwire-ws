</div>

      <footer class="footer">
        <div class="container-fluid">
          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script> - 2018 made with <i class="tim-icons icon-heart-2"></i> by
            <a href="javascript:void(0)" target="_blank">Creative Tim</a> for a better web.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="<?=$app->url('src/assets/admin')?>//js/core/jquery.min.js"></script>
  <script src="<?=$app->url('src/assets/admin')?>//js/core/popper.min.js"></script>
  <script src="<?=$app->url('src/assets/admin')?>//js/core/bootstrap.min.js"></script>
  <script src="<?=$app->url('src/assets/admin')?>//js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="<?=$app->url('src/assets/admin')?>//js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="<?=$app->url('src/assets/admin')?>//js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="<?=$app->url('src/assets/admin')?>//js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="<?=$app->url('src/assets/admin')?>//js/stats.js"></script>

  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    <?=$_data['page_script']?>
  </script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
</body>

</html>