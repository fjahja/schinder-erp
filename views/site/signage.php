<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="signage/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<title>Schinder Law Firm ERP</title>
</head>
<body>

<style type="text/css">
  html,
  body,
  .signage-wrapper {
    height: 100%;
  }
  .signage-wrapper .h50 {
    height: 50%;
  }
  .signage-wrapper .h475 {
    height: 47.5%;
  }
  .signage-wrapper .h33 {
    height: 33.33%;
  }
  .signage-wrapper .h5 {
    height: 5%;
  }
  .signage-wrapper .col-sm {
    border:1px solid black;
  }
  .signage-wrapper .signage-item.active {
    background: #00BCD4;
    color: white;
  }
  .signage-wrapper .signage-item.active .task-area {
    border-top: 1px solid white;
    padding-top: 15px;
    margin-top: 15px;
  }
  .signage-wrapper .signage-item.active .task-item {
    border-bottom: 1px solid white;
    padding-bottom: 15px;
    margin-bottom: 15px;
    font-size:14px;
  }
  .signage-wrapper .signage-item.active .task-item .timer {
    opacity: 0.5;
  }
  .time-zoner {
    border: 1px solid black;
  }
  .client-name {
    font-weight: bold;
    font-style: italic;
    opacity: 0.5;
  }
  .mb-none {margin-bottom:0;}

  /*animations*/
  .blinks {
    animation: blinker 1s linear infinite;
  }

  @keyframes blinker {  
    50% { opacity: 0; }
  }
</style>

<div class="container-fluid signage-wrapper">

  <div class="row h5 mb-none time-zoner">
    <div class="col">
      Jakarta: 
      <span class="time-item" style="line-height: 170%;">
        <? echo date('H'); ?><span class="blinks">:</span><? echo date('i | l, d F Y'); ?>
      </span>
    </div>
  </div>

  <div class="row h475">
    <div class="col-sm signage-item">
      <? echo $signage['view']['roy']; ?>
      <div class="task-area">
      </div>
    </div>
    <div class="col-sm signage-item">
      <? echo $signage['view']['dewi']; ?>
      <div class="task-area">
      </div>
    </div>
    <div class="col-sm signage-item">
      <? echo $signage['view']['budhi']; ?>
      <div class="task-area">
      </div>
    </div>
    <div class="col-sm signage-item">
      <? echo $signage['view']['mira']; ?>
      <div class="task-area">
      </div>
    </div>
  </div>

  <div class="row h475">
    <div class="col-sm signage-item">
      <? echo $signage['view']['erick']; ?>
      <div class="task-area">
      </div>
    </div>
    <div class="col-sm signage-item">
      <? echo $signage['view']['christin']; ?>
      <div class="task-area">
      </div>
    </div>
    <div class="col-sm signage-item">
      <? echo $signage['view']['juliani']; ?>
      <div class="task-area">
      </div>
    </div>
    <div class="col-sm signage-item">
    </div>
    <div class="task-area">
    </div>
  </div>

</div>

<!-- tray for active users ajax -->
<div class="active-users-tray"></div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="signage/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<script type="text/javascript">
  $(document).ready(function(){

      // top timer zoner
      var weekday = new Array(7);
      weekday[0] =  "Sunday";
      weekday[1] = "Monday";
      weekday[2] = "Tuesday";
      weekday[3] = "Wednesday";
      weekday[4] = "Thursday";
      weekday[5] = "Friday";
      weekday[6] = "Saturday";

      var monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
      ];

      window.setInterval(function(){

        var d = new Date();

        var t_hour = d.getHours();
        var t_minute = d.getMinutes();
        var t_date = d.getDate();
        var t_year = d.getFullYear();

        var t_day = weekday[d.getDay()]; 
        var t_mth = monthNames[d.getMonth()];

        t_minute = ('0' + t_minute).slice(-2);
        t_date = ('0' + t_date).slice(-2);

        $('.time-zoner .col .time-item').html(t_hour + '<span class="blinks">:</span>' + t_minute + ' - ' + t_day + ', ' + t_date + ' ' + t_mth + ' ' + t_year);

      }, 5000);

      // each second check if user have running contrib
      var placeholder = 1;
      window.setInterval(function(){
        $.post( "crud/contribution.php?v=signage_check", { placeholder })
          .done(function( data ) {

            // get var data from crud file, from function file
            $('.active-users-tray').html(data);

            // first set all signage-item to inactive
            $('.signage-item').removeClass('active');

            // scan active users and set the box to blue
            $('.active-users-tray .active-user').each(function(){

              var activeUserId = $(this).attr('data-id');

              // set the box to blue
              $('.user'+activeUserId).parent('.signage-item').addClass('active');

              // get the tasks for each active user
              var Form = {user_id:activeUserId};
              $.post( "crud/contribution.php?v=active_user_tasks", { Form })
                .done(function( data2 ) {
                  
                  $('.user'+activeUserId).parent('.signage-item').find('.task-area').html(data2);

              });
            });


            // erase html content of box that are not active
            $('.signage-item').each(function(){
              if(!$(this).hasClass('active')){
                $(this).find('.task-area').html('');
              }
            });

        });
      }, 5000);

  });
</script>



</body>
</html>