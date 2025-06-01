<?php
require_once 'db_connect.php';
session_start();
$loginError = " ";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    $stmt = $conn->prepare("SELECT password FROM students WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["username"] = $username;
            header("Location: welcome.php");
            exit;
        } else {
            $loginError = "Invalid password.";
        }
    } else {
        $loginError = "Username not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Italiana&family=Jacques+Francois&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Jacques+Francois&display=swap" rel="stylesheet">
	    <title>
		    English School
	    </title>
    </head>
    <body>
        <div id="headder">
            <!--<img src="images/headder.webp" alt="headder image">-->
            <h1>Be a champion of education</h1>
            <button><a href="#register">START NOW!</a></button>
        </div>
        <main>
            <h2>Overview</h2>
            <div id="overview" class="page">
                
                <p >Welcome to our English school, where language learning fits your lifestyle. 
                    Whether you prefer studying online from the comfort of your home or face-to-face in a dynamic classroom setting, 
                    we offer flexible options to meet your needs. 
                    Our experienced teachers and supportive learning environment make it easy to achieve your English goals.
                </p>
                <img  src="images/classroom.jpg" alt="classroom">
                <img id="study" src="images/study.jpg" alt="study">
            </div>
            <h2>Testimonials</h2>
            <div class="page">
                <div class="testimonials">
                    <img src="images/MichaelCera.jpg" alt="Michael Cera">
                    <blockquote>
                        “I was nervous about learning English online, but this school made it so easy and enjoyable. The teachers are patient and the classes are very interactive. 
                        I've improved my speaking skills a lot and now feel more confident at work.”
                    </blockquote>
                    <h4>Michael Cera</h4>
                </div>
                <div class="testimonials" id="hurem">
                    <img src="images/HürremSultan.jpg" alt="Hürrem Sultan">
                    <blockquote>
                        “Studying in person helped me stay motivated. The atmosphere is friendly, and the teachers really care about your progress.
                        I went from basic to intermediate English in just a few months!”
                    </blockquote>
                    <h4>Hürrem Sultan</h4>
                </div>
                <div class="testimonials">
                    <img src="images/JakePeralta.jpg" alt="Jake Peralta">
                    <blockquote>
                        “Studying abroad was the best decision I’ve made. I lived in London for three months and not only improved my English, 
                        but also made friends from all over the world. It was a life-changing experience.”
                    </blockquote>
                    <h4>Jake Peralta</h4>
                </div>
            </div>
            <h2>About Us</h2>
            <div class="page" class="courcesAndSchool">
                <div id="cources" class="courcesAndSchool">
                    <img src="images/courses.png" alt="cources">
                    <div class="text">
                    <h3>Cources</h3>
                    <p>
                        We offer a wide range of English courses for all levels and purposes. Whether you're preparing for exams, improving business English, or learning for travel and everyday life, 
                        we’ve got a course that’s right for you. Choose from online lessons, in-person classes, or a combination of both for maximum flexibility.
                    </p>
                    </div>
                </div>
                
                <div id="foreignSchool" class="courcesAndSchool">
                    <img src="images/foreignSchool.jpg" alt="study abroad">
                    <div class="text">
                    <h3>Study Abroad</h3>
                    <p>
                        Take your learning experience to the next level with our study abroad programs. Travel to English-speaking countries, immerse yourself in the culture, and practice your language skills in real-life situations. 
                        It’s a unique opportunity to accelerate your progress and make unforgettable memories.
                    </p>
                    </div>
                </div>
            </div>
            <div id="register" class="page">
                <div id="cards">
                    <div id="online" class="classtypebox">
                        <h4>ONLINE</h4>
                        <div class="description">
                            <h4>300TL</h4>
                            <ul>
                                <li>Learn from anywhere, anytime</li>
                                <li>Live lessons with flexible scheduling</li>
                                <li>Ideal for busy or remote learners</li>
                            </ul>
                        </div>
                        
                    </div>
                    <div id="inSchool" class="classtypebox">
                        <h4>IN SCHOOL</h4>
                        <div class="description">
                            <h4>400TL</h4>
                            <ul>
                                <li>In-person learning with real-time interaction</li>
                                <li>Group practice and classroom activities</li>
                                <li>Great for structure and routine</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <button><a href="register.html"> Start Now!</a></button>
            </div>
            <div class="page" id="singin">
                <div id="singintext">
                <h2>Already our Student?</h2>
                <h3>Sing In</h3></div>
                <?php if ($loginError): ?>
                <p style="color:red;"><?= $loginError ?></p>
                <?php endif; ?>
                <form method="POST" action="">
                    <div id="form">
                        <label>USERNAME</label>
                        <input type="text" name="username" placeholder="Username" required><br>
                        <label>PASSWORD</label>
                        <input type="password" name="password" placeholder="Password" required><br>
                        <button type="submit">Sign In</button>
                    </div>
                </form>
            </div>
        </main>
        <div id="contact">
            <div id="contactbox">
                <h2>Contact Us</h2>
                    <h3>Phone:</h3>
                    <p>(505)555-55-55</p>
                    <h3>Email:</h3> 
                    <p>englishschool@school.edu.tr</p>
                    <h3>Adress:</h3> 
                    <p>Karabuk/Merkez</p>
            </div>
        </div>
        <footer>
            <p>Project was done by Mahri Atamammedova and Büşra Ören</p>
        </footer>
    </body>
</html>