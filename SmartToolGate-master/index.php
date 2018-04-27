<?php
    $filepath = realpath (dirname(__FILE__));
	require_once($filepath."api/db_connect.php");
    $db = new DB_CONNECT();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ADD Money</title>
    
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" media="screen" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    
    
</head>
<body>
<div class="container">
        
        <div class="row">
            
            <div class="col-md-12">
                <h1></h1>
            </div>
            
        </div>
        
        
        <div class="row">
            
            <div class="col-md-3">
                
            </div>
<?php
        $result = mysql_query("SELECT * FROM SmartTollGate") or die(mysql_error());
        $row = mysql_fetch_array($result);
        $tag = $row["Rtag"];
        $bal = $row["Balance"];
        <div class="col-md-6">
                
                <div class="jumbotron">
                    <div class="container">
                        
                        
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        
                        
                    </div>
                </div>
                
            </div>
?>
    <div class="col-md-3">
                
                </div>
            </div>
    <script src="//code.jquery.com/jquery.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>