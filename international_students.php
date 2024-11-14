<?php
 header("Content-Type: text/html;charset=utf-8");
 if (!isset($_SESSION)) { session_start(); }
?>
<!DOCTYPE html>
<html lang="zh">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>International Students</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="shortcut icon" type="image/x-icon" href="images/homepage/logos.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- css -->
    <?php
        include('call_css.php');
     ?>
</head>
<style>
        .bg-green {
        background-color: #07889B;
        color: black;
    }
    
    .dropdown-menu a:hover {
    background-color: white;
    }

    .dropdown:hover .dropdown-menu {
        display: block;
    }
    
    .bg-orange {
        background-color: #e37222;
        color: black;
    }
    
    .bg-orange2 {
        background-color: #EEAA7B;
        color: black;
    }
    
    .bg-green2 {
        background-color: #66B9BF;
        color: black;
    }
    
    .nav-link {
        color: black;
    }
    
    .navbar-light .navbar-nav .nav-link {
        color: black
    }
    
    .navbar-dark .navbar-nav .nav-link {
        color: black;
    }
    
    .navbar-inverse .navbar-brand {
        color: black;
    }
    
    .navbar-expand-sm {
        -ms-flex-flow: row nowrap;
        flex-flow: row nowrap;
        -ms-flex-pack: start;
        justify-content: space-around;
    }
    
    .row .content {
        vertical-align: bottom;
    }
    
    .page-link {
        color: black;
    }
    
    tr {
        border-bottom: 1pt solid #9f9f9f;
    }
    
    img {
        margin-top: 15px;
        margin-bottom: 15px;
        vertical-align: bottom;
    }
    
    .navbar-brand img {
        margin-top: 0px;
        margin-bottom: 0px;
    }
    
    h2 {
        margin-top: 15px;
        margin-left: 15px;
    }
    
    a {
        color: black;
    }
    
    li {
        float: initial;
    }
    
    p {
        margin: 15px;
    }
    
    #header { font-size: 18px; } footer {
        text-align: center;
        font-size: 8px;
        left: 0;
        bottom: 0;
        width: 100%;
        color: black;
    }
    
    .photo {
        text-align: center;
    }
</style>
<body>
    <?php include "navbar.php"?>
    <div class="container">
        <?php include "header.php"?>
        <div class="content" style="margin-top: 15px; margin-bottom: 15px;">
            <ul class="nav nav-tabs" style="margin: 15px;">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#section1">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section2">Downloads</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#section3">Q&A</a>
                </li>
            </ul>
            <div class="tab-content">
                <div id="section1" class="container tab-pane active">
                    <h2>About Us</h2>
                    <ul>
                        <li style="font-weight:bold;">Introduction</li>
                        <p>Student Services and Dormitory Division, care about our students with all our heart to offer heartfelt service and proper source to help those who face problems or any difficulties in their daily lives. With the result, they can study intently and develop the good living habits.</p>
                        <p>&nbsp;</p>

                        <li style="font-weight:bold;">Service</li>
                        <p>– Student Loans</p>
                        <p>– Scholarships</p>
                        <p>– Student Award and Discipline</p>
                        <p>– Dormitory Services</p>
                        <p>– Emergency Relief</p>
                        <p>– National Military Service</p>
                        <p>– Tuition Reduction and Exemption</p>
                        <p>&nbsp;</p>

                        <li style="font-weight:bold;">Contact Us</li>
                        <a href="mailto:ncu7221@ncu.edu.tw">ncu7221@ncu.edu.tw</a>
                        <p>&nbsp;</p>
                    </ul>
                </div>
                <div id="section2" class="container tab-pane active">
                    <h2>Downloads</h2>
                    <ul>
                        <li><a href="download/Student Rewards and Punishments.pdf">Student Rewards and Punishments</a></li>
                        <li><a href="download/Leave of Absence Application.doc">Leave of Absence Application</a></li>
                        <li><a href="download/Implementation Regulations of National Central University’s Student Emergency Relief Fund.pdf">Implementation Regulations of National Central University’s Student Emergency Relief Fund</a></li>
                        <li><a href="download/Application Form for Emergency Relief Fund.pdf">Application Form for Emergency Relief Fund</a></li>
                    </ul>
                    <br>
                    <hr><br>
                </div>
                
                <div id="section3" class="container tab-pane active">
                    <h2>Q&A</h2>
                    <div id="FAQ" class="tabcontent" style="display: block;">
                        <div style="margin: 15px;">
                            <h4 style="font-weight:bold;">Rewards and Punishments</h4>
                            <h4>Q1. Whether parents will be notified when the school is approved of Minor demerit?</h4>
                            <p>ANS：According to the school regulations of the student’s rewards and penalties, the students are given Major demerit or Major merit than above, the parents of the students will be notified.</p>
                            <br>
                        </div>
                        <h2 style="font-weight:bold;">Leave of Absence</h2>
                        <div style="margin: 15px;">
                            <h4>Q2. How to get the leave of absence application?</h4>
                            ANS：Please log in to the portal website, click on the Service Desk to access the Student Affairs section, select Leave Application, and submit it. Choose the appropriate category for the type of leave you are requesting.
                            <br><br>
                            <h4>Q3. When students take leave collectively to participate in a competition outside the school, how to apply for leave?</h4>
                            ANS：Taking the relevant certified documents and student list, and all the participating students must fill in the leave request to send “Student Service and Dormitory Division " to apply for official leave matters.
                            <br><br>
                            <h4>Q4. What are the procedures for taking leave abroad?</h4>
                            ANS：Please fill out the leave form on the portal website. For leave requests of 4 days or more, please obtain prior approval from the Office of International Affairs.
                            <br><br>
                            <h4>Q5. What is the utility of Proof of leave?</h4>
                            ANS：As a certificate for leave, it can be provided to teachers to confirm the absence.
                            <br><br>
                            <h4>Q6. Can the applications be applied afterward?</h4>
                            ANS：Due to unavoidable and significant events, applications can be submitted within one week from the day after the last day of leave.
                            <br><br>
                            <h4>Q7. How can I apply for official leave?</h4>
                            ANS： Must have approval or signature of school administration or the activity manager.
                            <br><br>
                            <h4>Q8. The regulations of leave of absence application that the leave request should be known in advance as a class teacher. If the class teacher can't find the signature on the leave form, what should I do?</h4>
                            ANS：You can send an email or message to the teacher explaining the reason for your absence, and upload a screenshot of the message to the leave application system to apply for leave.
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr><br>
    </div>

    <?php include "footer.php"?>
</body>

</html>