<!--This is the sign up page-redirect to server-->
<?php 

require('./connect.php');

// Function to sanitize user inputs
function sanitize_input($input) {
    // Implement your sanitization logic here
    // For example, you can use mysqli_real_escape_string() or other methods
    return htmlspecialchars(trim($input));
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstname = isset($_POST['firstname']) ? sanitize_input($_POST['firstname']) : '';
    $lastname = isset($_POST['lastname']) ? sanitize_input($_POST['lastname']) : '';
    $username = isset($_POST['username']) ? sanitize_input($_POST['username']) : '';
    $emailpass = isset($_POST['emailpas']) ? sanitize_input($_POST['emailpas']) : '';
    $password = isset($_POST['password']) ? sanitize_input($_POST['password']) : '';
    $confirmpass = isset($_POST['confirmpass']) ? sanitize_input($_POST['confirmpass']) : '';

    if ($firstname && $lastname && $username && $emailpass && $password && $confirmpass) {
        // Add your database connection logic here if it's not already included
        require "./connect.php";

        // Check if the username already exists in the database
        $check_query = "SELECT * FROM users WHERE username=?";
        $check_stmt = $connect->prepare($check_query);
        $check_stmt->bind_param('s', $username);
        $check_stmt->execute();
        $result = $check_stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>
                    alert('Username already exists. Please choose a different username.');
                  </script>";
        } else {
            // Prepare the SQL statement using a prepared statement to prevent SQL injection
            $insert_stmt = $connect->prepare("INSERT INTO users (firstname, lastname, username,emailpass, password)  
                                            VALUES (?, ?, ?, ?, ?)");

            // Check if the passwords match before inserting
            if ($password === $confirmpass) {
                // Hash the password for secure storage
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Bind parameters and execute the query
                $insert_stmt->bind_param('sssss', $firstname, $lastname, $username, $emailpass, $hashed_password);
                $insert_stmt->execute();

                // Check if the query was successful
                if ($insert_stmt->affected_rows > 0) {
                    echo "<script>
                            alert('Registration Successful. Welcome!');
                            window.location = 'portal-login.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Kindly try again');
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Passwords do not match');
                      </script>";
            }

            // Close the statement for insertion
            $insert_stmt->close();
        }

        // Close the connection and statement for checking username
        $check_stmt->close();
        $connect->close();
    } else {
        echo "<script>
                alert('All fields are required');
              </script>";
    }
}

?>

<!DOCTYPE html>
<html>
   
    <head>
        <meta data-rh="true" charset="UTF-8">
        <meta name="author" content="denismytin@gmail.com">

        <meta data-rh="true" content="origin" name="referrer">
        <meta name="robots" content="index, follow">
        <meta name="referrer" content="unsafe-url">
        <meta http-equiv="X-UA-Compatible" content="IE-edge, chrome=1">
        <meta name="google-site-verification" content="">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="fb:pages" content="12123243443">
        
        <meta name="keywords" content="in Nyeri Town, Near St Marys Boys High school, Nyeri Central, school, learn, study, students, admission, online study, head teacher, teacher, alumni, uniform, school bus,
        school,
private school,
jss,
high school,
schools near me,
primary school,
secondary,
homeschooling,
high schools near me,
online school,
secondary education,
primary schools near me,
primary education,
secondary schools near me,
schooling,
catholic schools near me,
home school programs,
online school programs,
online high school,
better education,
high secondary,
home learning,
educational website,
best secondary schools near me,
catholic high,
online summer school,
good education,
primary and secondary education,
home ed,
catholic education office,
private education,
online schools near me,
lower secondary education,
online schools high school,
best online school,
primary teaching,
home schools near me,
home school online,
online middle school,
secondary students,
we schools,
primary students,
catholic secondary schools near me,
high school online classes,
lower secondary,
secondary class,
it school near me,
junior secondary,
primary and mass education,
best secondary schools,
need of education,
lower education,
new schools,
school online classes,
education 2022,
educational learning,
your education,
best primary schools,
private s,
home teaching,
lower primary,
human education,
schools near me for teaching,
secondary teaching,
primary secondary education,
kids home school,
www primary education,
lower primary classes,
educational experiences,
home ed class,
near schools near me,
secondary ed,
primary education classes,
improving education,
education year,
secondary education classes,
educational institutions near me,
junior secondary schools,
systemic education,
top secondary schools,
online teaching schools,
education and schooling,
a good education,
junior primary,
separate education,
schools need to help,
private schools in,
online schools middle school,
primary 7,
institutional education,
education in 2022,
catholic ed,
jss a">
        
<meta name="description" content="A leading day and boarding private and primary school for Preparatory, Lower, Primary and Junior Secondary Education in Nyeri Town, Nyeri Central, Nyeri. 9 Students Joined this month! What are you waiting for? Join Now!">


        <title data-rh="true">Sign Up - Consolata School - Nyeri (PRIMARY & JUNIOR SECONDARY)</title>
        <link rel="alternate" href="" hreflang="x-default">
        <link rel="alternate" href="" hreflang="en">
        <link rel="alternate" href="" hreflang="ja">
        <link rel="alternate" href="" hreflang="fr">
        <link rel="alternate" href="" hreflang="de">
        <link rel="alternate" href="" hreflang="es">
        <link data-rh="true" rel="apple-touch-icon" sizes="152x152" href="">
        <link data-rh="true" id="glyph_preload_link" rel="preload" as="style" type="text/css" href="">
        <link rel="apple-touch-icon-precomposed" sizes="57x57" href="">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="">
        <link rel="apple-touch-icon-precomposed" sizes="120x120" href="">
        <link rel="apple-touch-icon-precomposed" sizes="152x152" href="">
        <link rel="icon" type="image/png" type="favicon" href="">
        <link rel="mask-icon" href="">
        <meta name="ms.prod" content="Consolata School - Nyeri (PRIMARY & JUNIOR SECONDARY)">
        <meta name="ms.TOCTitle" content="Consolata School - Nyeri (PRIMARY & JUNIOR SECONDARY)">
        <meta name="ms.ContentId" content="4567-6532-2314-2323-2323gtbre">
        <meta name="ms.date" content="10/7/2023">
        <meta name="ms.topic" content="Consolata School - Nyeri (PRIMARY & JUNIOR SECONDARY)">
        <meta name="msapplication-TitleColor" content="#ffffff">
        <meta name="msapplication-TitleImage" content="">
        <meta name="theme-color" content="#454545">
        <meta data-rh="true" property="al:android:url" content="akkadian://p/32edd2n2d">
        <meta data-rh="true" property="al:ios:url" content="akkadian://p/32g3evd232">

        <!--Facebook Opegraph Metadata-->

        <meta property="og:title" content="Consolata School - Nyeri (PRIMARY & JUNIOR SECONDARY)">
        <meta property="og:description" content="A leading day and boarding private and primary school for Preparatory, Lower, Primary and Junior Secondary Education in Nyeri Town, Nyeri Central, Nyeri. 9 Students Joined this month! What are you waiting for? Join Now!">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="./images/Denis-Profile-removebg-preview.png">
        <meta property="og:image-height" content="300">
        <meta property="og:image-width" content="300">
        <meta property="og:site_name" content="Name">
        <!--Twitter Opegraph Metadata-->
        <meta name="twitter:label1" content="">
        <meta name="twitter:data1" content="">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@code">
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="@websitename">
        <meta data-rh="true" property="twitter:title" content="Web title">
        <meta data-rh="true" name="twitter:app:url:iphone" content="akkadian://p/32bdjh1nc">

        <meta data-rh="true" name="twitter:app:name:iphone" content="medium">
        <meta data-rh="true" name="twitter:app:id:iphone" content="4356342">
        <meta data-rh="twitter:image:src" content="link to image src">
        <meta data-rh="true" property="article:author" content="denismytin@gmail.com">
        <meta data-rh="true" property="al:ios:app_name" content="Medium">
        <meta data-rh="true" property="al:ios:app_store_id" content="325353345">
        <meta data-rh="true" property="al:android:package" content="com.cps.customer">
        <meta data-rh="true" property="al:android:app_name" content="CPS school">
        <meta data-rh="true" property="fb:app_id" content="538240810">
        <meta data-rh="true" property="og:site_name" content="Medium">
        <meta data-rh="true" property="software:upload_time" content="2019-01016t04:14:27.243z">
        <meta data-rh="true" property="al:web:url" content="link">
        <link rel="preconnect" href="">

        <!-- Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="#293a4a">

        <!-- Mobile Chrome-->
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="mobile-web-app-status-bar-style" content="default">

        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="default">

        <link rel="search" type="application/opensearchdescription+xml" title="Metadata" href="">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="./yahoo.css">
        <link rel="stylesheet" type="text/css" href="log-form.css">

        <link rel="shortcut icon" href="./images/cpslogomain.png" type="image/x-icon">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/45fbaa9681.js" crossorigin="anonymous"></script>

        
        <!--Bootstrap-->
        
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        
        
    </head>
    <body>
        <nav class="nav nav-bar linksContainer">
            <a href="./index.html" class="yahooText">Consolata School - Nyeri (PRIMARY & JSS)</a>
            <a href="tel:0799009363" class="yahooHelp">help</a>
        </nav>
        <main style="width: 90%;" class="cpslogwrapper">
            <div class="videoWrapper">
                <video id="cpslogvideo" src="./videos/Computer Programming Motivation.mp4" controls>
                    <source sizes="" srcset="" type="image/">
                    <p class="alternateText">Consolata School - Nyeri (PRIMARY & JSS) Introduction</p>
                </video>
                <p class="videoText">I Will Better My Best.</p>
                <a href="./portal-login.php" target="_top"  class=" btn-reg btn btn-round btn-primary">
                    Login
                </a>
            </div>
            
            <!--loginWrapper is the main container for tab contents-->
                <div class="loginWrapper">

                <!--Container for tab buttons-->
                <div class="tab_buttons">
                    <button class="regtabbtn btn btn-primary" id="defaultReg" onclick="startRegTab(event, 'studentRegistrar')">LEARNER</button>
                    <button class="regtabbtn btn btn-primary" id="forTeacherreg" onclick="startRegTab(event, 'staffRegistrar')">STAFF</button>
                </div>
                <!--Container for both staff and student login-->    
                <div class="tabcontents main_tabcontents">
                    <div class="regtabcontent" id="studentRegistrar">
                        <div class="UserSignUp">
                            <p class="yahooText yahooLogo">Learner Sign Up</p>
                            <p class="signInText">Sign Up</p>
                            <form class="sign-up" method="post" action="reg-form.php">
                                <input type="text" name="firstname" tabindex="0" id="f-name" class="input" placeholder="First Name" required><br>
                                <input type="text" name="lastname" id="s-name" class="input" placeholder="Surname" required><br>
                                <input type="text" name="username" id="n-name" class="input" placeholder="Registration Number" required><br>
                                <input type="email" name="emailpas" id="e-mail" class="input" placeholder="User Email" required><br>
                                <input type="password" name="password" class="input" id="initial-passcode" placeholder="Passcode" pattern="[a-z0-5]{8,}" minlength="8" required><br>
                                <input type="password" name="confirmpass" class="input" id="confirm-passcode" placeholder="Confirm Passcode" pattern="[a-z0-5]{8,}" minlength="8" required><br>
                                <label for="proimg">Upload profile photo</label>
                                <input type="file" name="profileimg" id="proimg" class="input" placeholder="User profile"><br>

                                <div class="redirect-login">
                                <p >Already a User?<a href="./portal-login.php" style="color: #000;">Log In</a></p>
                                </div>
                                <div class="terms">
                                <input type="checkbox" name="agree" id="agree" required><span>Agree to <a href="terms" style="color: #000;">our Terms & Conditions</a></span><br>
                                </div>
                                <input type="submit" name="regDetails" id="u-data" value="Welcome">
                            </form>
                            </div>
                    </div>
    
                    <div class="regtabcontent" id="staffRegistrar">
                        <div class="UserSignUp">
                            <p class="yahooText yahooLogo">Staff Sign Up</p>
                            <p class="signInText">Sign Up</p>
                            <form class="sign-up" method="post" action="reg-form.php">
                                <input type="text" name="firstname" tabindex="0" id="f-name" class="input" placeholder="First Name" required><br>
                                <input type="text" name="lastname" id="s-name" class="input" placeholder="Surname" required><br>
                                <input type="text" name="username" id="n-name" class="input" placeholder="Staff Id" required><br>
                                <input type="email" name="emailpas" id="e-mail" class="input" placeholder="User Email" required><br>
                                <input type="password" name="password" class="input" id="initial-passcode" placeholder="Passcode" minlength="8" required><br>
                                <input type="password" name="confirmpass" class="input" id="confirm-passcode" placeholder="Confirm Passcode" pattern="[a-z0-5]{8,}" minlength="8" required><br>
                                <div class="redirect-login">
                                <p >Already a User?<a href="./portal-login.php" style="color: #000;">Log In</a></p>
                                </div>
                                <div class="terms">
                                <input type="checkbox" name="agree" id="agree" required><span>Agree to <a href="terms" style="color: #000;">our Terms & Conditions</a></span><br>
                                </div>
                                <input type="submit" name="regDetails" id="u-data" value="Welcome">
                            </form>
                            </div>
                    </div>
                </div>
                </div>
            

           
        </main>
        <div class="cpscopyright">
            <a href="lin.html" class="terms">Terms |</a>
            <a href="lin.html" class="privacy">Privacy</a>
        </div>
    </body>
    <script src="reg-form.js"></script>
    <script src="user_registration.js"></script>

</html>




