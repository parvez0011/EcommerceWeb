
<?php require_once("..//resources//config.php"); 
?>
 
<?php include(TEMPLATE_FRONT.DS."header.php");
?>


    <!-- Page Content -->
    <div class="container">

        <div class="row">

<!-- catogaries here -->
<?php include(TEMPLATE_FRONT.DS."side_nav.php");
?>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                  
                  <?php include(TEMPLATE_FRONT.DS."slider.php");
?>

                    </div>

                </div>

                <div class="row">

<!-- Php code starts from here  --> 


<?php
 get_products();

?>            
                </div>

            </div>

        </div>

    </div>

<?php include(TEMPLATE_FRONT.DS."footer.php");
?>