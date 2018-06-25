<!Doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Tech Auctions</title>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Custom styles for this template -->
        <link href="css/justified-nav.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../assets/js/ie-emulation-modes-warning.js"></script>
        <style>
            .jumbotron .btn{
                border-radius: 0;
            }

            .btn {
                border-radius: 0;
            }
        </style>
        <style>

        tbody {
            counter-reset: rowNumber;
        }

        tbody tr {
            counter-increment: rowNumber;
        }

        tbody tr td:first-child::before {
            content: counter(rowNumber);
            min-width: 1em;
            margin-right: 0.5em;
        }

        </style>
    </head>
    <body>
        <img src="img/tech_image.jpg" class="img-responsive back1" alt="Responsive image" style="z-index: -1; position:fixed; opacity: 0.5;"/>
        <div class="container">
            <header class="row">
                <nav>
                    <h6 class='col-xs-12'>&nbsp;</h6>
                    <div class='col-md-3'>
                        <div class='search-box'>
                            <form class='search-form'>
                                <input class='form-control' name="search" placeholder='product name..' type='text'>
                                <input type="hidden" name="categ" value="<?php if(isset($_GET["categ"])){ echo $_GET["categ"]; }else{ echo "";}; ?>">
                                <button type="submit" class='btn btn-link search-btn'>
                                    <i class='glyphicon glyphicon-search'></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="jumbotron col-md-9" id="topmen">
                        <div class="custombtn custombtn1"><span class="glyphicon glyphicon-home"></span> Home</div>
                        <?php if(!isset($_SESSION['user']))
                        {?>
                        <div class="custombtn custombtn3"><span class="glyphicon glyphicon-ok-sign"></span> Sign up</div>
                        <div class="custombtn custombtn2"><span class="glyphicon glyphicon-log-in"></span> Sign in</div>
                        <?php
                        }else{?>
                            <div class="custombtn custombtn4" style="width: 69%;display: inline-block;"></span>Welcome! <?php echo $_SESSION['user']?></div>
                            <div class="custombtn custombtn5"style="display: inline-block;"><span class="glyphicon glyphicon-log-in"></span><a href="logout.php">Sign out</a></div>
                        <?php 
                        }
                        ?>
                    </div>
                </nav>
                <div id="myModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close cross" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="gridSystemModalLabel" style="font-size:1.5em">tech auctions</h4>
                            </div>
                            <div class="modal-body">
                                <form action="" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="abc@email.com">
                                        <div class="error"><?php if(isset($user->error['email'])) echo $user->error['email']; ?></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="password">
                                        <div class="error"><?php if(isset($user->error['password'])) echo $user->error['password']; ?></div>
                                    </div>
                                    <div class="form-group">
                                        <p class="help-block"><a href="mypage.html">Don't have an account? Sign up!</a></p>
                                    </div>
                                    <button type="submit" class="btn btn-default btn-default1" name="login" style="width:100%;">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

