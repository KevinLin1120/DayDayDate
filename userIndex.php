<?php
//Get schedule data
    session_start();
    require("./includes/dbConn.inc.php");
    $userID = $_SESSION["_id"];
    $sql_query = "SELECT _id, userId, title, stDT, enDT, 
    color, isPublic FROM schedule WHERE userId = ?";
    // $sql_query = "SELECT * FROM schedule";

    $stmt = $db_link -> prepare($sql_query);
    $stmt-> bind_param('i', $userID);
    $stmt -> execute();
    // $stmt -> store_result();
    $stmt -> bind_result($id, $userId, $title, $stDT, $enDT, $color, $isPublic);
    // $result = $db_link -> query($sql_query);
    

    // $total = $result -> num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset='utf-8' />
    <link href='./calender/src/main.css' rel='stylesheet'>
    <script src='./calender/src/main.js'></script>

    <script src="./calender/src/locales-all.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="card/cards.html"></script> --><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
    <script src="./calender/src/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet"  href="./calender/style.css">
    <link rel="stylesheet"  href="./calender/card/cards.css">

</head>
<body>
    <?php
        require('./header.php');
        require('./calender/calendar.php');
        
        //Get DB data
        // while($row_result = $result -> fetch_assoc()){
        //     echo ('<h1>' . $row_result['_id'] . '</h1>');
        // }
    ?>
    <script>
        var scheData = [];
        var title, stDT, enDT;
        // $scheData;
        //Get DB data
        <?php while($stmt -> fetch()) {?>
                id = "<?php echo $id ?>";
                title = "<?php echo $title ?>";
                stDT = "<?php echo $stDT ?>";
                enDT = "<?php echo $enDT ?>";
                    scheData.push({
                        id: id,
                        title: title,
                        start: stDT,
                        end: enDT
                    });
               
        <?php    
        } ?>
        
        // var data = [{title:"test1",start:"2022-0601",end:""}];
        
        // for(var i = 0; i < total; i++){
            
        //     data.append({title: });
        //     console.log("t");
        // }
        

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale:'zh-tw',
            navLinks: true,

            headerToolbar:{
                left:'prev,next today',
                center:'title',
                right:'dayGridMonth,dayGridWeek',
                
            },
            //Schedule events
            events: scheData,
            // id: setID, title: setTitle, start: setDateStart, end: setDateEnd,
            selectable: true, //Let schedule selectable
            selectHelper: true,
            select: function(event){

            }
            //   events:[
            //     { title:"test1",start:"2022-0601 16:40:03",end:""},
            //     {title:"test2",start:"2022-0502T11:00:00",end:"2022-0502T12:00:00"},
            //     {title:"test3",start:"2022-0509T11:00:00",end:"2022-0511T11:00:00"}
            //   ]

            });
            calendar.render();

            
            // $('#confirm').click(function(){
            //     //console.log("yes");
            //     const SetTitle = document.getElementById('title');
            //     setTitle = SetTitle.value;
            //     //console.log(setTitle);
                
            //     const SetStartTime = document.getElementById('startDT');
            //     setDateStart = SetStartTime.value;
            //     //console.log(setDateStart);

            //     const SetEndTime = document.getElementById('endDT');
            //     setDateEnd = SetEndTime.value;
            //     // console.log(setDateEnd);

            //     console.log(setTitle,setDateStart,setDateEnd);
            //     calendar.addEvent({title: setTitle, start: setDateStart,end: setDateEnd});
            //     // header("Location: ./includes/addSche.inc.php");
            // });
        });
    </script>
</body>
</html>