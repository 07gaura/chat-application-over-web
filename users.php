<?php
session_start();
include "config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script src="http://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
    .msg-box{
        display:inline;
        left: 500px;
        width: 30%;
        background-color:white;     
        top: 70px;
        position:absolute;
        height: 500px;
        border: 2px solid black;
        display: none;
    }

    .top-box{
        width:100%;
        height: 35px;
        background-color: aqua;
    }

    .closebtn{
        position:absolute;
        right:10px;
        top: 2px;
        font-size: 25px;
    }

    .center-box{
        height: 400px;
        overflow-y:auto;
    }
    .msg{
        margin:5px;
        padding:5px;
        background:grey;
        border-radius: 5px; 
       
    }

    .last-box{
        width: 100%;
        position:absolute;
        display:flex;
        margin:5px;
    }

    .last-box .inputtxt{
        border-radius: 30px;
        width: 80%;
    }

    .sendbtn{
        margin:5px;
        font-size: 40px
    }
</style>
<body>
    <div class="container">
        <div class="col-md-12">
            <br>
            <h1>WelCome <?php echo $_SESSION["username"]; ?></h1>
            
        </div>
        <div class="col-md-12" align="right">
            <a href="logout.php">logout</a>
        </div>
        <div class="col-md-12" id="userdata">

        </div>
        <div class="msg-box" >
            <div class="top-box">
                <p>username</p><i class="fa fa-times-circle closebtn" aria-hidden="true"></i>
            </div>
            <div class="center-box">
                <div class="msg">
                <i class="fa fa-user-circle" aria-hidden="true"></i>username
                <i>time</i>
                <p>this is a demo message</p>
                </div>
                <div class="msg">
                <i class="fa fa-user-circle" aria-hidden="true"></i>username
                <i>time</i>
                <p>this is a demo message</p>
                </div>
                <div class="msg">
                <i class="fa fa-user-circle" aria-hidden="true"></i>username
                <i>time</i>
                <p>this is a demo message</p>
                </div>
                <div class="msg">
                <i class="fa fa-user-circle" aria-hidden="true"></i>username
                <i>time</i>
                <p>this is a demo message</p>
                </div>
                <div class="msg">
                <i class="fa fa-user-circle" aria-hidden="true"></i>username
                <i>time</i>
                <p>this is a demo message</p>
                </div>
                <div class="msg">
                <i class="fa fa-user-circle" aria-hidden="true"></i>username
                <i>time</i>
                <p>this is a demo message</p>
                </div>
                <div class="msg">
                <i class="fa fa-user-circle" aria-hidden="true"></i>username
                <i>time</i>
                <p>this is a demo message</p>
                </div>
            </div>
            <div class="last-box">
                
                <input type="text" class="inputtxt" id="message">
                <i class="fa fa-telegram sendbtn" aria-hidden="true"></i>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        
        setInterval(function(){
            update_last_activit()
            load_data();
        }, 5000);
        function load_data(){
            $.ajax({
                url:"fetch_user.php",
               type: "POST",
                success: function(data){
                    $("#userdata").html(data);
                }
            })

        }
    })

        function update_last_activit(){
            $.ajax({
                url:"update_last_activity.php",
                success: function(data){}
            })
        }

        

       $(document).on("click", "#chatbtn",function(e){
            e.preventDefault();
            $(".msg-box").show();
            
            var toid = $(this).data("touserid");
            var tousername = $(this).data("tousername");
            var fromid = $(this).data("fromuserid");
            var fromusername = $(this).data("fromusername");
            setInterval(function(){
                fetch_msg(toid, fromid);
        }, 1000);
            

            function fetch_msg(toid, fromid){
                $.ajax({
                    url:"fetch_message.php",
                    type:"POST",
                    data:{toid:toid, fromid:fromid},
                    success:function(data){
                        $(".center-box").html(data);
                    }
                })
             }
            $(".sendbtn").click(function(){
                var msg = $("#message").val();
                
                $.ajax({
                    url:"insert-msg.php",
                    type:"POST",
                    data:{to_id:toid, tousername:tousername,  from_id:fromid, msg:msg, fromusername:fromusername} ,
                    success:function(data){
                        if(data==1){
                        fetch_msg(toid, fromid);
                        $(".inputtxt").trigger("reset");
                    }
                    }
                });
            })
            
        })


        $(document).on("click", ".closebtn",function(e){
            $(".msg-box").hide();

        })
    
</script>
</body>
</html>