<?php 
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Alfa Andamios - Contacto</title>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <!--[if IE 6]>
        <link rel="stylesheet" type="text/css" href="css/iecss.css" />
        <![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        
    </head>
    <body>
        <div id="main_container">
            <div id="header">
                <?php include_once 'header.php';?>    
            </div>
            <div id="main_content">
                <div id="menu_tab">
                    <?php include_once 'menu.php'; ?>
                </div>
                <!-- end of menu tab -->
                <div class="crumb_navigation"> Navigation: <span class="current">Contacto</span> </div>
                <div class="left_content">
                    
                    <?php include_once 'menu-left.php'; ?>
                    
                </div>
                <!-- end of left content -->
                <div class="center_content">
                    <div class="center_title_bar">Contactenos</div>
                    <div class="prod_box_big">
                        <div class="center_prod_box_big">
                            <div class="contact_form">                                
                                <div class="form_left">
                                    <div>Tel&eacute;fonos</div>
                                    (011) 4203-3005<br />
                                    (011) 4214-4101 <br />
                                    (011) 4293-3769<br />
                                    
                                    <div>E-mails</div>
                                    info@andamiosalfa.com.ar
                                </div>
                                <div class="form_right">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3275.7352118486288!2d-58.3991474!3d-34.812602999999996!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcd366140aa3d7%3A0x866d8577d7a9173!2sAv+Hip%C3%B3lito+Yrigoyen+13551%2C+Malvinas+Argentinas%2C+Buenos+Aires!5e0!3m2!1sen!2sar!4v1410621263634"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of center content -->
                <div class="right_content">
                    
                    <?php include_once 'menu-right.php'; ?>
                    
                </div>
                <!-- end of right content -->
            </div>
            <!-- end of main content -->
            
            <?php include_once 'footer.php'; ?>
            
        </div>
        <!-- end of main_container -->
        <script language="Javascript">
            document.oncontextmenu = function(){return false}
        </script>
    </body>
</html>