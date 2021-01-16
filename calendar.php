<?php
include_once('assets/include/session_header.php');
include_once('assets/include/utils.php');
$title = 'View Calendar';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/nurse/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>AcumenHOSPITALS | <?php echo $title; ?></title>

    <!-- Font Awesome -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- fullCalendar -->
    <link rel="stylesheet" href="assets/plugins/fullcalendar/main.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="home/" class="nav-link">Home</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                    <?php echo $loggedInNurse['first_name'] . ' ' . $loggedInNurse['last_name']; ?></a>
                <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow text-center">
                    <li><a href="profile/<?php echo $loggedInNurse['nurse_id']; ?>" class="dropdown-item">Profile </a></li>
<!--                    <li><a href="#" class="dropdown-item">Settings</a></li>-->

                    <li class="dropdown-divider"></li>

                    <li>
                        <a href="logout.php" class="btn btn-danger btn-block">
                            Logout
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include_once('assets/include/side_bar.php') ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->
        <?php include_once('assets/include/content_header.php'); ?>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sticky-top mb-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Duty Schedule</h4>
                                </div>
                                <div class="card-body">
                                    <!-- the events -->
                                    <div id="external-events">
                                        <div class="external-event bg-success">ON DUTY</div>
<!--                                        <div class="external-event bg-warning">Go home</div>-->
<!--                                        <div class="external-event bg-info">Do homework</div>-->
<!--                                        <div class="external-event bg-primary">Work on UI design</div>-->
                                        <div class="external-event bg-danger">OFF DUTY</div>
                                        <div class="checkbox">
                                            <label for="drop-remove">
                                                <input type="checkbox" id="drop-remove">
                                                remove after drop
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Create Event</h3>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                        <ul class="fc-color-picker" id="color-chooser">
                                            <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                            <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                        </ul>
                                    </div>
                                    <!-- /btn-group -->
                                    <div class="input-group">
                                        <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                        <div class="input-group-append">
                                            <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                        </div>
                                        <!-- /btn-group -->
                                    </div>
                                    <!-- /input-group -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="col-12">
                            <div class="alert alert-info text-center font-weight-bold" role="alert">
                                The calendar below shows your working schedule for the next 5 days.
                            </div>
                        </div>
                        <div class="card card-primary">
                            <div class="card-body p-0">
                                <!-- THE CALENDAR -->
                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include_once('assets/include/footer.php'); ?>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- jQuery UI -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="assets/plugins/moment/moment.min.js"></script>
<script src="assets/plugins/fullcalendar/main.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- Bootstrap -->


<script>
    $(function () {

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            ele.each(function () {

                // create an Event Object (https://fullcalendar.io/docs/event-object)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()) // use the element's text as the event title
                }

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject)

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex        : 1070,
                    revert        : true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                })

            })
        }

        ini_events($('#external-events div.external-event'))

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date()
        var d    = date.getDate(),
            m    = date.getMonth(),
            y    = date.getFullYear()

        var Calendar = FullCalendar.Calendar;
        var Draggable = FullCalendar.Draggable;

        var containerEl = document.getElementById('external-events');
        var checkbox = document.getElementById('drop-remove');
        var calendarEl = document.getElementById('calendar');

        // initialize the external events
        // -----------------------------------------------------------------

        new Draggable(containerEl, {
            itemSelector: '.external-event',
            eventData: function(eventEl) {
                return {
                    title: eventEl.innerText,
                    backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                    borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
                    textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
                };
            }
        });

        // [
        //     {
        //         title          : 'ON DUTY',
        //         start          : new Date(y, m, 1),
        //         backgroundColor: '#008000', //green
        //         borderColor    : '#008000', //green
        //         allDay         : true
        //     },
        //     {
        //         title          : 'Long Event',
        //         start          : new Date(y, m, d - 5),
        //         end            : new Date(y, m, d - 2),
        //         backgroundColor: '#f39c12', //yellow
        //         borderColor    : '#f39c12' //yellow
        //     },
        //     {
        //         title          : 'Meeting',
        //         start          : new Date(y, m, d, 10, 30),
        //         allDay         : false,
        //         backgroundColor: '#0073b7', //Blue
        //         borderColor    : '#0073b7' //Blue
        //     },
        //     {
        //         title          : 'Lunch',
        //         start          : new Date(y, m, d, 12, 0),
        //         end            : new Date(y, m, d, 14, 0),
        //         allDay         : false,
        //         backgroundColor: '#00c0ef', //Info (aqua)
        //         borderColor    : '#00c0ef' //Info (aqua)
        //     },
        //     {
        //         title          : 'Birthday Party',
        //         start          : new Date(y, m, d + 1, 19, 0),
        //         end            : new Date(y, m, d + 1, 22, 30),
        //         allDay         : false,
        //         backgroundColor: '#00a65a', //Success (green)
        //         borderColor    : '#00a65a' //Success (green)
        //     },
        //     {
        //         title          : 'Click for Google',
        //         start          : new Date(y, m, 28),
        //         end            : new Date(y, m, 29),
        //         url            : 'https://www.google.com/',
        //         backgroundColor: '#3c8dbc', //Primary (light-blue)
        //         borderColor    : '#3c8dbc' //Primary (light-blue)
        //     }
        // ]

        const schedule = [];
        let dayCount = '<?php echo $loggedInNurse['day_count']; ?>';
        dayCount = Number(dayCount);

        for (let i = 0; i < 5; i++){
            if (dayCount > 3){
                dayCount = 0;
            }
            let day = d+i;
            if (dayCount === 0){
                evnt = {
                    title          : 'OFF DUTY',
                    start          : new Date(y, m, day, 12, 0),
                    end          : new Date(y, m, day+1, 12, 0),
                    allDay         : true,
                    backgroundColor: '#FF0000', //Info (aqua)
                    borderColor    : '#FF0000' //Info (aqua)
                }
                schedule.push(evnt);
            }else if (dayCount > 0 && dayCount <= 3){
                evnt = {
                    title          : 'ON DUTY',
                    start          : new Date(y, m, day, 12, 0),
                    end          : new Date(y, m, day+1, 12, 0),
                    allDay         : true,
                    backgroundColor: '#008000', //Info (aqua)
                    borderColor    : '#008000' //Info (aqua)
                }
                schedule.push(evnt);
            }
            dayCount++;
        }

        console.log(d);

        var calendar = new Calendar(calendarEl, {
            headerToolbar: {
                left  : 'prev,next today',
                center: 'title',
                right : 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            themeSystem: 'bootstrap',
            //Random default events
            events: schedule,
            editable  : true,
            droppable : true, // this allows things to be dropped onto the calendar !!!
            drop      : function(info) {
                // is the "remove after drop" checkbox checked?
                if (checkbox.checked) {
                    // if so, remove the element from the "Draggable Events" list
                    info.draggedEl.parentNode.removeChild(info.draggedEl);
                }
            }
        });

        calendar.render();
        // $('#calendar').fullCalendar()

        /* ADDING EVENTS */
        var currColor = '#3c8dbc' //Red by default
        // Color chooser button
        $('#color-chooser > li > a').click(function (e) {
            e.preventDefault()
            // Save color
            currColor = $(this).css('color')
            // Add color effect to button
            $('#add-new-event').css({
                'background-color': currColor,
                'border-color'    : currColor
            })
        })
        $('#add-new-event').click(function (e) {
            e.preventDefault()
            // Get value and make sure it is not null
            var val = $('#new-event').val()
            if (val.length == 0) {
                return
            }

            // Create events
            var event = $('<div />')
            event.css({
                'background-color': currColor,
                'border-color'    : currColor,
                'color'           : '#fff'
            }).addClass('external-event')
            event.text(val)
            $('#external-events').prepend(event)

            // Add draggable funtionality
            ini_events(event)

            // Remove event from text input
            $('#new-event').val('')
        })
    })
</script>
</body>

</html>
