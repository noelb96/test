<?php
namespace core\sellWatch;
include_once("crud_.php");
include_once ("send.php");
session_start();


if (isset($_REQUEST['submit'])){

// Seot the upload target directory
    $target_path = "sellWatchStorage/";

    for($i=1;$i<=5;$i++) {
        $attachments = 'attachment_'.$i;
        $attachmentdiv = 'attachmentdiv_'.$i;
        $FileName = $_FILES[$attachments]['name'];
        // Check if filename is empty
        if($FileName != "") {
            $FileType = $_FILES[$attachments]['type'];
            $FileExtension = strtolower(substr($FileName,strrpos($FileName,'.')+1));
            // Check for supported file formats
            if($FileExtension != "gif" && $FileExtension != "jpg" && $FileExtension != "png")
            {
                echo "<script type='text/javascript'>parent.document.getElementById('typeerrormessage').style.display = 'inline';</script>";
            }
            else
            {
                $FileSize = round($_FILES[$attachments]['size']/1024);
                // Check for file size
                if($FileSize > 1000000)
                {
                    echo "<script type='text/javascript'>parent.document.getElementById('sizeerrormessage').style.display = 'inline';</script>";
                }
                else {
                    $FileTemp = $_FILES[$attachments]['tmp_name'];
                    $FileLocation = $target_path.basename($FileName);
                    // Finally Upload
                    if(move_uploaded_file($FileTemp,$FileLocation)) {
                        // On successful upload send a message to corresponding attachmentdiv from which the file came from
                        echo "<script type='text/javascript'>parent.document.getElementById('".$attachmentdiv."').innerHTML = '<input CHECKED type=\"checkbox\"><a href=\"http://abhinavsingh.com/webdemos/upload/".$FileName."\" target=\"_blank\"><font size=2><b>".$FileName."</b> <i>(".$FileType.")</i> ".$FileSize." Kb</font>';</script>";
                        echo "<script type='text/javascript'>parent.document.getElementById('typeerrormessage').style.display = 'none';</script>";
                        echo "<script type='text/javascript'>parent.document.getElementById('sizeerrormessage').style.display = 'none';</script>";
                    }
                    else {
                        echo "There was an error uploading the file, please try again!";
                    }
                }
            }
        }

        $watch = new sellWatch("", $_REQUEST['name'], $_REQUEST['email'], $_REQUEST['phone'], $_REQUEST['brand'], $_REQUEST['model'], $_REQUEST['price'], $FileName, $_REQUEST['papers'], $_REQUEST['service'], $_REQUEST['comments']);
        $crud = new crud_();
        $crud->create($watch);
    }



    sendAdminMail($_REQUEST['email'], $_REQUEST['name'], $_REQUEST['email'], $_REQUEST['phone']);

}
?>
<html>
<head>
    <title>The Watch Shop LLC</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="css/sellpage.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script type="text/javascript">
        // Javascript function which takes care for multiple uploads
        var attachmentlimit = 5; // Limiting maximum uploads to 5
        var attachmentid = 1;
        function attachmore() { // Function is called when user presses Attach Another File
            attachmentid += 1;
            document.getElementById('attachmentdiv').innerHTML += '<div id="attachmentdiv_' + attachmentid + '" style="margin-top:5px"><input type="file" id="attachment_' + attachmentid + '" name="attachment_' + attachmentid + '" size="30" onchange="document.uploadattachments.submit();"/></div>';
            if(attachmentid == attachmentlimit) {
                document.getElementById('addanother').style.display='none';
            }
        }
    </script>

</head>

<body>
<div class="top">
    <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container nopad">
            <div class="try"></div>
            <div><img src="logo_90x90%20px.png" height="90px" width="90px"  style="float: left; margin-left: 50px;" ></div>
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a class="right" href="homepage.php">Home</a>
                    </li>
                    <li>
                        <a class="right" href="#">Sell your watch</a>
                    </li>
                    <li>
                        <a class="right" href="tradepage.php">Watch trading</a>
                    </li>
                    <li>
                        <a class="right" href="allWatch.php">Watch for sale</a>
                    </li>
                    <li>
                        <a class="right" href="show_testimonials.php">Testimonials</a>
                    </li>
                    <li>
                        <a class="right" href="#Contact">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['userId'])){
                        echo "  <li>
                        <a class=\"right\" href=\"logout.php\">Logout</a>
                    </li>";
                    }else{echo "  <li>
                        <a class=\"right\" href=\"login.php\">Log in</a>
                    </li>";}
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>

        <!-- /.container -->
    </nav>
</div>

<div class="container main fill sell">
<div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <h3>Brands we buy</h3>
            <br/>
            <ul style="list-style-type: none">
                <li>Paner</li>
                <hr/>
                <li>Rolex</li>
                <hr/>
                <li>Audemars Piguet</li>
                <hr/>
                <li>Hublot</li>
                <hr/>
                <li>Breitling</li>
                <hr/>
                <li>Omega</li>
                <hr/>
                <li>Cartier</li>
                <hr/>
                <li>IWC</li>
                <hr/>
            </ul>
        </div>


        <div class="col-lg-4 col-md-4 col-sm-6 fill" >
            <h1>Sell us your watch</h1>
            <br/>
            <h2>  Four Easy Steps to Sell</h2>
            <img src="image/sellyw.png" style="float: none; width: 360px; height: 550px">
            <div class="box"><img src="tick.png"> &nbsp FREE and insured shipping (No cost to you)</div>



    </div>

        <div class="col-lg-4 col-md-4 col-sm-6 fill">
            <br/>
            <form id="uploadattachments" enctype="multipart/form-data" name="uploadattachments" target="attachmentiframe"  action="sellpage.php" method="post">
                <table>
                    <thead>
                    <tr style="background-color: lightgray">
                        <td>
                            <h3>Sell your watch</h3>
                        </td>
                    </tr>
                    <tr style="background-color: lightgray">
                        <td><h4>A watch expert will contact you within 24 hours</h4>
                        </td>
                    </tr>
                    </thead>
                    <tr>
                        <td><label><div class="r1">Name * </div><input type="text" name="name" required></label></td>
                    </tr><tr>
                        <td><label><div class="r1">Email * </div><input type="text" name="email" required></label></td>
                    </tr><tr>
                        <td><label><div class="r1">Phone * </div><input type="number" name="phone" required></label></td>
                    </tr>
                    <tr>
                        <td><div class="select"><div class="r1">Brand * </div>
                                <label>
                                    <select name="brand" >
                                        <option> - Select -</option>
                                        <option value="paner">Panerai</option>
                                        <option value="paner">Audemars Piguet</option>
                                        <option value="paner">Hublot</option>
                                        <option value="rolex">Rolex</option>
                                        <option value="omega">Omega</option>
                                        <option value="omega">Breitling</option>
                                        <option value="omega">Cartier</option>
                                    </select>
                                </label></div></td>
                    </tr>
                    <tr>
                        <td><label><div class="r1">Model * </div><input type="text" name="model" required></label></td>
                    </tr>
                    <tr>
                        <td><label><div class="r1">Name your price * </div><input type="text" name="price" required></label></td>
                    </tr>
                    <tr><td>
                       <label>Pictures </label>
                        <div id="attachmentdiv" style="margin-left:10px">
                            <iframe name="attachmentiframe" style="display:none"></iframe>
                            <div id="attachmentdiv_1">
                                <input type="file" id="attachment_1" name="attachment_1" size="30" onchange="document.uploadattachments.submit();"/>
                            </div>
                        </div>
                        <!-- div showing error message for invalid file type -->
                        <div id="typeerrormessage" style="display:none;margin-left:30px">
                            <font color=#990000 size=1>Only png, jpg and gif file type are supported</font>
                        </div>
                        <!-- div showing error message for exceeded file size -->
                        <div id="sizeerrormessage" style="display:none;margin-left:30px">
                            <font color=#990000 size=1>File exceeded maximum allowed limit of 10000 Kb</font>
                        </div>
                            <br/>
                        <div id="addanother" style="float:right; margin-right:60px;margin-top:5px">
                            <a href="javascript:void(0)" onclick="attachmore();"><font size=4>Attach another file</font></a>
                        </div>
                        </td>
                    </tr>

                <tr>
                    <td><div class="select"><div class="r1">Boxes/Papers </div>
                            <label>
                                <select name="papers">
                                    <option value="none">None</option>
                                    <option value="none">Only Box</option>
                                    <option value="none"> Only Papers </option>
                                    <option value="none"> Box & Papers </option>
                            </label></div></td>
                </tr>
                    <tr>
                        <td><label><div class="r1">Last Service Date </div><input type="text" name="service"></label></td>
                    </tr>
                    <tr>
                        <td><label><div class="r1">Comments </div><input type="text" name="comments"></label></td>
                    </tr>
                    <tr><td><input class="buton" type="submit" name="submit" value="submit"/></td></tr>
                </table>
            </form>
        </div>
    </div>
</div>



</body>
<footer>
<?php include('footer.php'); ?>
</footer>

</html>