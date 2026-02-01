
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="img/user.png" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name"><?php echo $user['name'];?></div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Manager</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>
    <ul class="nav menu">
    <?php 
        if (isset($_GET['dashboard'])){ ?>
            <li class="active">
                <a href="index.php?dashboard"><em class="fa fa-dashboard">&nbsp;</em>
                    Dashboard
                </a>
            </li>
        <?php } else{?>
            <li>
                <a href="index.php?dashboard"><em class="fa fa-dashboard">&nbsp;</em>
                    Dashboard
                </a>
            </li>

            
        <?php }
        if (isset($_GET['reservation'])){ ?>
            <li class="active">
            <a href="index.php?reservation"><em class="fa fa-calendar">&nbsp;</em>
                    Reservation
                </a>
            </li>
        <?php } else{?>
            <li>
            <a href="index.php?reservation"><em class="fa fa-calendar">&nbsp;</em>
                    Reservation
                </a>
            </li>
        
        <?php }
         if (isset($_GET['reservationlist'])){ ?>
            <li class="active">
                <a href="index.php?reservationlist"><em class="fa fa-list">&nbsp;</em>
                List of Bookings
                </a>
            </li>
        <?php } else{?>
        <li>
            <a href="index.php?reservationlist"><em class="fa fa-list">&nbsp;</em>
            List of Bookings
            </a>
        </li>
<?php }
        if (isset($_GET['booking_calendar'])){ ?>
            <li class="active">
                <a href="booking_calendar.php?booking_calendar"><em class="fa fa-bed">&nbsp;</em>
                Booking Calendar
                </a>
            </li>
        <?php } else{?>
            <li>
            <a href="booking_calendar.php?booking_calendar"><em class="fa fa-bed">&nbsp;</em>
            Booking Calendar
                </a>
            </li>
        <?php }
        if (isset($_GET['rooms_calendar'])){ ?>
            <li class="active">
                <a href="rooms_calendar.php?rooms_calendar"><em class="fa fa-users">&nbsp;</em>
                Rooms Calendar
                </a>
            </li>
        <?php } else{?>
            <li>
                <a href="rooms_calendar.php?rooms_calendar"><em class="fa fa-users">&nbsp;</em>
                Rooms Calendar
                </a>
            </li>
        
            <?php }
        ?>

        <?php
        if (isset($_GET['canceled_reservations_list'])){ ?>
            <li class="active">
                <a href="index.php?canceled_reservations_list"><em class="fa fa-folder-open">&nbsp;</em>
                Canceled Bookings
                </a>
            </li>
        <?php } else{?>
            <li>
                <a href="index.php?canceled_reservations_list"><em class="fa fa-folder-open">&nbsp;</em>
                Canceled Bookings
                </a>
            </li>
        <?php }
        ?>

        <?php
        if (isset($_GET['history_reservation'])){ ?>
            <li class="active">
                <a href="index.php?history_reservation"><em class="fa fa-pie-chart">&nbsp;</em>
                    Bookings History 
                </a>
            </li>
        <?php } else{?>
        <li>
            <a href="index.php?history_reservation"><em class="fa fa-pie-chart">&nbsp;</em>
            Bookings History 
            </a>
        </li>
     
        <?php }
        ?>
  <!-- -->
        <?php
       
        if (isset($_GET['tools'])){ ?>
            <li class="active">
                <a href="index.php?tools"><em class="fa fa-cogs">&nbsp;</em>
                    Tools
                </a>
            </li>
        <?php } else{?>
        <li>
            <a href="index.php?tools"><em class="fa fa-cogs">&nbsp;</em>
            Tools
            </a>
        </li>
<?php }?>


  <!-- -->
    </ul>
</div><!--/.sidebar-->