<?php
session_start();
//error_reporting(0);
include('doctor/includes/dbconnection.php');
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $mobnum = $_POST['phone'];
    $email = $_POST['email'];
    $appdate = $_POST['date'];
    $aaptime = $_POST['time'];
    $specialization = $_POST['specialization'];
    $doctorlist = $_POST['doctorlist'];
    $message = $_POST['message'];
    $aptnumber = mt_rand(100000000, 999999999);
    $cdate = date('Y-m-d');

    if ($appdate <= $cdate) {
        echo '<script>alert("Appointment date must be greater than todays date")</script>';
    } else {
        $sql = "insert into tblappointment(AppointmentNumber,Name,MobileNumber,Email,AppointmentDate,AppointmentTime,Specialization,Doctor,Message)values(:aptnumber,:name,:mobnum,:email,:appdate,:aaptime,:specialization,:doctorlist,:message)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':aptnumber', $aptnumber, PDO::PARAM_STR);
        $query->bindParam(':name', $name, PDO::PARAM_STR);
        $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':appdate', $appdate, PDO::PARAM_STR);
        $query->bindParam(':aaptime', $aaptime, PDO::PARAM_STR);
        $query->bindParam(':specialization', $specialization, PDO::PARAM_STR);
        $query->bindParam(':doctorlist', $doctorlist, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);

        $query->execute();
        $LastInsertId = $dbh->lastInsertId();
        if ($LastInsertId > 0) {
            echo '<script>alert("Your Appointment Request Has Been Send. We Will Contact You Soon")</script>';
            echo "<script>window.location.href ='index.php'</script>";
        } else {
            echo '<script>alert("Something Went Wrong. Please try again")</script>';
        }
    }
}
?>
<!DOCTYPE html>

<!--
 // WEBSITE: https://themefisher.com
 // TWITTER: https://twitter.com/themefisher
 // FACEBOOK: https://www.facebook.com/themefisher
 // GITHUB: https://github.com/themefisher/
-->

<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Novena- Health Care &amp; Medical template</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Health Care Medical Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Novena HTML Template v1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/images/favicon.png" />

    <!-- 
  Essential stylesheets
  =====================================-->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/icofont/icofont.min.css">
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
    <link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
    <script>
    function getdoctors(val) {
        //  alert(val);
        $.ajax({

            type: "POST",
            url: "get_doctors.php",
            data: 'sp_id=' + val,
            success: function(data) {
                $("#doctorlist").html(data);
            }
        });
    }
    </script>

</head>

<body id="top">

    <header>
        <div class="header-top-bar">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <ul class="top-bar-info list-inline-item pl-0 mb-0">
                            <li class="list-inline-item"><a href="mailto:support@gmail.com"><i
                                        class="icofont-support-faq mr-2"></i>support@novena.com</a></li>
                            <li class="list-inline-item"><i class="icofont-location-pin mr-2"></i>Address Ta-134/A, New
                                York, USA </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="text-lg-right top-right-bar mt-2 mt-lg-0">
                            <a href="tel:+23-345-67890">
                                <span>Call Now : </span>
                                <span class="h4">823-4565-13456</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navigation" id="navbar">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <img src="images/logo.png" alt="" class="img-fluid">
                </a>

                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarmain"
                    aria-controls="navbarmain" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icofont-navigation-menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarmain">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="service.html">Services</a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="department.html" id="dropdown02"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Department <i
                                    class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown02">
                                <li><a class="dropdown-item" href="department.html">Departments</a></li>
                                <li><a class="dropdown-item" href="department-single.html">Department Single</a></li>

                                <li class="dropdown dropdown-submenu dropright">
                                    <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0301" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdown0301">
                                        <li><a class="dropdown-item" href="index.html">Submenu 01</a></li>
                                        <li><a class="dropdown-item" href="index.html">Submenu 02</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="doctor.html" id="dropdown03"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Doctors <i
                                    class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown03">
                                <li><a class="dropdown-item" href="doctor.html">Doctors</a></li>
                                <li><a class="dropdown-item" href="doctor-single.html">Doctor Single</a></li>
                                <li><a class="dropdown-item" href="appoinment.html">Appoinment</a></li>

                                <li class="dropdown dropdown-submenu dropleft">
                                    <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0501" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdown0501">
                                        <li><a class="dropdown-item" href="index.html">Submenu 01</a></li>
                                        <li><a class="dropdown-item" href="index.html">Submenu 02</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="blog-sidebar.html" id="dropdown05"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blog <i
                                    class="icofont-thin-down"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdown05">
                                <li><a class="dropdown-item" href="blog-sidebar.html">Blog with Sidebar</a></li>
                                <li><a class="dropdown-item" href="blog-single.html">Blog Single</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <section class="page-title bg-1">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block text-center">
                        <span class="text-white">Book your Seat</span>
                        <h1 class="text-capitalize mb-5 text-lg">Appoinment</h1>

                        <!-- <ul class="list-inline breadcumb-nav">
            <li class="list-inline-item"><a href="index.html" class="text-white">Home</a></li>
            <li class="list-inline-item"><span class="text-white">/</span></li>
            <li class="list-inline-item"><a href="#" class="text-white-50">Book your Seat</a></li>
          </ul> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="appoinment section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="mt-3">
                        <div class="feature-icon mb-3">
                            <i class="icofont-support text-lg"></i>
                        </div>
                        <span class="h3">Call for an Emergency Service!</span>
                        <h2 class="text-color mt-3">+84 789 1256 </h2>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="appoinment-wrap mt-5 mt-lg-0 pl-lg-5">
                        <h2 class="mb-2 title-color">Book an appoinment</h2>
                        <p class="mb-4">Mollitia dicta commodi est recusandae iste, natus eum asperiores corrupti qui
                            velit . Iste dolorum atque similique praesentium soluta.</p>
                        <form role="form" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="name" id="name" type="text" class="form-control"
                                            placeholder="Full Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="email" id="name" type="email" class="form-control"
                                            placeholder="Full Email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="phone" id="phone" type="telephone" class="form-control"
                                            placeholder="Phone Number">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="date" id="date" type="date" class="form-control"
                                            placeholder="dd/mm/yyyy">
                                    </div>
                                </div>



                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input name="time" id="time" type="time" class="form-control"
                                            placeholder="Time">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select onChange="getdoctors(this.value);" name="specialization"
                                            id="specialization" class="form-control" required>
                                            <option value="">Select specialization</option>
                                            <!--- Fetching States--->
                                            <?php
                                            $sql = "SELECT * FROM tblspecialization";
                                            $stmt = $dbh->query($sql);
                                            $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                            while ($row = $stmt->fetch()) {
                                            ?>
                                            <option value="<?php echo $row['ID']; ?>">
                                                <?php echo $row['Specialization']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>




                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select name="doctorlist" id="doctorlist" class="form-control">
                                            <option value="">Select Doctor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group-2 mb-4">
                                <textarea name="message" id="message" class="form-control" rows="6"
                                    placeholder="Your Message"></textarea>
                            </div>

                            <button type="submit" class="form-control  btn btn-main btn-round-full bg-dark"
                                name="submit" id="submit-button">Book
                                Now</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <!-- footer Start -->
    <footer class="footer section gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mr-auto col-sm-6">
                    <div class="widget mb-5 mb-lg-0">
                        <div class="logo mb-4">
                            <img src="images/logo.png" alt="" class="img-fluid">
                        </div>
                        <p>Tempora dolorem voluptatum nam vero assumenda voluptate, facilis ad eos obcaecati tenetur
                            veritatis eveniet distinctio possimus.</p>

                        <ul class="list-inline footer-socials mt-4">
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/themefisher"><i class="icofont-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://twitter.com/themefisher"><i class="icofont-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.pinterest.com/themefisher/"><i class="icofont-linkedin"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget mb-5 mb-lg-0">
                        <h4 class="text-capitalize mb-3">Department</h4>
                        <div class="divider mb-4"></div>

                        <ul class="list-unstyled footer-menu lh-35">
                            <li><a href="#!">Surgery </a></li>
                            <li><a href="#!">Wome's Health</a></li>
                            <li><a href="#!">Radiology</a></li>
                            <li><a href="#!">Cardioc</a></li>
                            <li><a href="#!">Medicine</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="widget mb-5 mb-lg-0">
                        <h4 class="text-capitalize mb-3">Support</h4>
                        <div class="divider mb-4"></div>

                        <ul class="list-unstyled footer-menu lh-35">
                            <li><a href="#!">Terms & Conditions</a></li>
                            <li><a href="#!">Privacy Policy</a></li>
                            <li><a href="#!">Company Support </a></li>
                            <li><a href="#!">FAQuestions</a></li>
                            <li><a href="#!">Company Licence</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="widget widget-contact mb-5 mb-lg-0">
                        <h4 class="text-capitalize mb-3">Get in Touch</h4>
                        <div class="divider mb-4"></div>

                        <div class="footer-contact-block mb-4">
                            <div class="icon d-flex align-items-center">
                                <i class="icofont-email mr-3"></i>
                                <span class="h6 mb-0">Support Available for 24/7</span>
                            </div>
                            <h4 class="mt-2"><a href="mailto:support@email.com">Support@email.com</a></h4>
                        </div>

                        <div class="footer-contact-block">
                            <div class="icon d-flex align-items-center">
                                <i class="icofont-support mr-3"></i>
                                <span class="h6 mb-0">Mon to Fri : 08:30 - 18:00</span>
                            </div>
                            <h4 class="mt-2"><a href="tel:+23-345-67890">+23-456-6588</a></h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-btm py-4 mt-5">
                <div class="row align-items-center justify-content-between">
                    <div class="col-lg-6">
                        <div class="copyright">
                            Copyright &copy; 2021, Designed &amp; Developed by <a
                                href="https://themefisher.com/">Themefisher</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="subscribe-form text-lg-right mt-5 mt-lg-0">
                            <form action="#" class="subscribe">
                                <input type="text" class="form-control" placeholder="Your Email address" required>
                                <button type="submit" class="btn btn-main-2 btn-round-full">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <a class="backtop scroll-top-to" href="#top">
                            <i class="icofont-long-arrow-up"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- 
    Essential Scripts
    =====================================-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="plugins/jquery/jquery.js"></script>
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <script src="plugins/slick-carousel/slick/slick.min.js"></script>
    <script src="plugins/shuffle/shuffle.min.js"></script>

    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA"></script>
    <script src="plugins/google-map/gmap.js"></script>

    <script src="js/script.js"></script>

</body>

</html>