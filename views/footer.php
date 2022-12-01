</div><!-- View Loader -->
</div><!-- Global container -->
<script src="src/libs/js/jquery.js"></script>
<script src="src/libs/js/dt.js"></script>

<script src="src/libs/js/icons.js"></script>
<!-- <script src="src/js/min/viewloader.min.js?version=<?php echo $v ?>"></script> -->
<script src="src/js/select_company.js"></script>



<script src="src/js/configs.js?version=<?php echo $v ?>"></script>

<?php if ($_SERVER['REMOTE_ADDR'] == "::1") :  //archivos de desarrollo?>
    <script src="src/js/viewloader.js?version=<?php echo $v ?>"></script>
    <script src="src/js/script.js?version=<?php echo $v ?>"></script>
<?php else :  //archivo de produccion?>
    <script src="src/js/min/script.min.js?version=<?php echo $v ?>"></script>
<?php endif; ?>

<!-- <script src="src/js/app.js"></script> -->
<script src="src/libs/js/sweetalert.js"></script>
<script src="src/libs/js/jquery-ui.js"></script>
</body>

</html>