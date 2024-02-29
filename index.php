
<!DOCTYPE html>
<html>
<head>
    <title>EMPLOYER ATTENDERS SYSTEM</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
           body {
            background-color:  #e0dbdf;
            width:100%;
            height: 100%;
        }
        .form-bg {
            background-color: #f4f6f8; 
        }
        .navbar {
            background-color: #4b0150;
        }
        .navbar .nav-link {
            color: white; 
            text-align: center; 
        }
        .navbar .nav-link:hover {
            color: yellow;
        }

    
        .topic {
            text-align: center;
            color: #350339;
            font-size: 40px;
            margin-top: 20px;
        }
        .tpic{
            border-style: solid;
          
            width: 700px;
            margin-left: 410px;
            background-color: #d8d5d8;
            margin-top: 50px;
            height: 100px;
            border-radius: 20px;
        }
        .wlc{
            text-align: center;
            color: #ffffff;
        }
        .click{
            text-align: center;
            color: #ffffff;
        }
        .lnk{
            text-align: center;
            text-decoration: none;
            color: #ffffff;
        }
 
    </style>
</head>
<body>
        <header class="header">
                   
    </div>
        </header>

<nav class="navbar navbar-expand-lg navbar-dark " >
        <P class="navbar-brand mx-auto">EMPLOYER AVAILABILITY CHECKING SYSTEM</P>
    </nav>
    <div style="margin-top:-120px">
    <div class="container d-flex justify-content-center align-items-center"
        style="min-height: 100vh; background-color: #e0dbdf;">
    
        <form class="border shadow p-3 rounded form-bg"
            action="check-login.php" 
            method="post" 
            style="width: 450px;">

            <div class="mb-3">
                <label for="username" 
                    class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" >
            </div>
            <div class="mb-3">
                <label for="password" 
                    class="form-label">Password</label>
                <input type="password" 
                    name="password" 
                    class="form-control" 
                    id="password">
            </div>
            <div class="mb-1">
                <label class="form-label">Role</label>
            </div>
            <select class="form-select mb-3"
                    name="role" 
                    aria-label="Default select example">


                <option selected value="Employer" >Employer</option>
                <option value="Leader" >Leader</option>
                


            </select>
            <button type="submit" 
                    class="btn d-block mx-auto" name="submit" style="background-color:#4b0150; color:white">LOGIN</button>
        </form>
    </div>


<footer class="bg-light fixed-bottom">
            <p class="text-center fw-bold"></p>
        </footer>

