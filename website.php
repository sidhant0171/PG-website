<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'connection.php';

    $stmt = $conn->prepare("INSERT INTO ContactInfo (Name, Email, PhoneNo, Comment) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $name, $email, $phone, $comment);

    
    $name = $_POST['name'];                              
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $comment = $_POST['comment'];

    $stmt->execute();
    
    
    if ($stmt->affected_rows > 0) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    
    $conn->close();
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<style>



    body {
        margin: 0;
        padding: 0;
        background: #002379;
        font-family: Montserrat, sans-serif !important;
    }

    .logobar {
        width: 100%;
        float: left;
        background: #002379;
        position: fixed;
        z-index: 10;
        left: 0;
        top: 0;

    }

    .logo-bar::before {
        max-width: 850px;
        max-height: 90px;
        position: absolute;
        content: '';
        background: url(https://xportsoft.com/custom-ecommerce-development-service/images/header-bg.png) center center/cover no-repeat;
        right: 0;
        z-index: 0;
        opacity: .25;
        width: 100%;
        height: 100%;
        top: 0;
    }

    .container {
        max-width: 80%;
        margin: auto;
        margin-top: 0;
    }

    .row {
        width: 100%;
        float: left;
    }

    .col_1 {
        width: 41.666667%;
        float: left;
        margin: 12px 0;
    }

    .col_1 img {
        max-width: 100%;
        max-height: 75px;
        float: left;
    }

    .col_2 {
        width: 58.333333%;
        float: left;

    }

    .col_2 i {
        font-size: 30px;
        background: white;
        color: #002379;
        padding: 7px 10px;
        border-radius: 5px;

    }

    .span {
        width: 33.33%;
        float: left;
        color: white;
    }

    .span .sub {
        margin-top: 25px;
        margin-right: 10px;
        width: 20%;

        float: left;
    }

    .span h4 {
        margin-top: 25px;
        width: 70%;
        float: left;
        font-weight: lighter;
    }

    .span button {
        margin-top: 25px;
        background-color: #46c0ec;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        margin-left: 50px;
    }


    .banner_content {
        width: 100%;
        float: left;
        background: #002379;
        margin-top: 99px;
    
    }

    .heading {
        width: 100%;
        float: left;
        margin: auto;
    }

    .heading h1 {
        
        width: 50%;
        float: left;
        font-size: 40px;
    }

    #heading_one {
        text-align: right;
        margin-top: 5px;
        color: white;
    }

    #heading_two {
        margin-top: 5px;
        text-align: left;
        color: red;
    }

    #heading_three {
        width: 100%;
        margin-top: -15px;
        text-align: center;
        color: #46c0ec;
    }


    .banner {
        width: 100%;
        float: left;
        background: rgb(0, 35, 121);
    }

    .banner .image {
        width: 66.666667%;
        float: left;
    }

    .banner .image img {
        width: 98%;
    }

    .banner .form {
        width: 33.333333%;
        float: left;
        background: rgba(70, 192, 236, .2);
        
    }

    .form_container {
        width: 90%;
        margin: auto;
        text-align: center;
    }

    .form_container h3 {
        color: white;
        font-weight: lighter;
    }

    .form_container h4 {
        color: #46c0ec;
        font-weight: bold;
        font-size: 18px;
        margin-top: -15px;
    }

    .title {
        margin-top: 50px;
    }

    .form button {
        margin-top: 25px;
        margin-bottom: 40px;
        background-color: #46c0ec;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        
    }

    input {
        margin-top: 10px;
        width: 80%;
        padding: 20px;
    }

    textarea {
        margin-top: 10px;
        width: 80%;
        padding: 20px;
    }

    
    .last {
        width: 100%;
        float: left;
        background-color: #e5f0ff;
        text-align: center;
    }

    .lines {
        margin-top: 50px;
    }

    .lines h1 {
        color: rgb(0, 35, 121);
        font-weight: bold;
        font-size: 50px;
    }

    .lines h2 {
        margin-top: -38px;
        color: #cd0001;
        font-weight: bold;
        font-size: 40px;
    }

    .one {
        width: 80%;
        display: flex;
        flex-wrap: wrap;
        margin: auto;
        color: #002379;
        font-size: 23px;
        justify-content: center;
    }

    .one i {
        margin-right: 5px;
        margin-left: 20px;
    }

    .one div {
        margin-bottom: 20px;
    }

    .down {
        width: 60%;
        margin: auto;
    
        margin-top: 25px;

        margin-bottom: 130px;
    }

    .down .start {
        width: 60%;
        float: left;
        color: white;
        background-color: #002379;
    }

    .down .contact {
        width: 40%;
        float: left;
        color: white;
        background-color: #cd0001;
    }

    .down a {
        color: white;
        text-decoration: none;
    }

    

    .skills {
        width: 100%;
        float: left;
        background-color: white;
    }

    .contain {
        width: 95%;
        margin: auto;
        margin-top: 40px;
    }

    .skill_content {
        width: 93%;
        margin: auto;
    }

    .skills h1 {
        font-size: 52px;
        font-weight: 800;
        text-align: center;
        color: #002379;
    }

    .color_red {
        color: #cd0001;
    }

    .skills p {
        font-family: Montserrat, sans-serif !important;
        text-align: center;
        margin-top: -20px;
        font-size: 20px;
        font-weight: 700;
        color: #cd0001;
    }

    .devide {
        width: 100%;
        float: left;
    }

    .first {
        width: 33.33%;
        float: left;
    }

    .left_divs {
        margin: 50px 0;
        width: 100%;
        text-align: right;
    }

    .left_divs h4 {
        color: #002379;
        font-size: 24px;
        font-weight: 600;
        line-height: 30px;
        margin-bottom: 13px;
    }

    .left_divs p {
        color: #1b4a63;
        text-align: right;
        font-size: 18px;
        font-weight: 400;
        line-height: 1.5;
    }

    .second {
        width: 33.33%;
        float: left;
    }

    .second img {
        width: 100%;
        margin-top: 170px;
    }

    .third {
        width: 33.33%;
        float: left;
    }

    .right_divs {
        margin: 50px 0;
        width: 100%;
    }

    .right_divs h4 {
        color: #002379;
        font-size: 24px;
        font-weight: 600;
        text-align: left;
        line-height: 30px;
        margin-bottom: 13px;
    }

    .right_divs p {
        color: #1b4a63;
        font-size: 18px;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
    }

    
    .right_divs p {
        color: #1b4a63;
        font-size: 18px;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
    }

    .request {
        width: 100%;
        float: left;
        background: #e3f1fc;
    }

    .request_container {
        width: 100%;
        float: left;
        margin: auto;
        padding: 40px 0;
    }

    .req_one {
        width: 75%;
        float: left;
    }

    .req_one p {
        font-size: 32px;
        font-weight: 700;
        color: #18408c;
        margin: 0 90px 0 0;
        line-height: 40px;
    }

    .req_two {
        width: 25%;
        float: left;

    }

    .color-blue-1 {
        color: #46c0ec;
    }

    .req_two p {
        background-color: #002379;
        color: white;
        padding: 15px 10px;
        text-align: center;
        transition: 0.5s ease-out;
        background: linear-gradient(to right, #002379 50%, #cd0001 50%);
        background-size: 200% 100%;
    }

    .req_two p:hover {
        background-position: -100% 0;
    }

    .req_two a {
        color: #fff;
        text-decoration: none;
        font-size: 16px;
    }

    .req_two i {
        font-size: 16px;
        position: relative;
        top: 2px;
    }
    /* / modal popup / */
        .modal {
            width: 100%;
            height: 100%;
            position: fixed;
            z-index: 5;
            /* display:none; */
            top: 0;
            background-color: rgba(0, 0, 0, 0.8);
        }
        .modal .form{
            width: 34%;
    height: 100%;
    left: 30%;
    bottom:20px;
    top: 15%;
    position: fixed;
    text-align: center;
        background: blue;

        }

        .modal form {
            width: 100%;
                    height: auto;
            left: 40%;
            text-align: center;
        }

        .modal form h2,
        h4 {
            margin: 0;
            color: #fff;
            padding: 0px;
        }

        .modal form hr {
            width: 100%;
        }

        .modal form strong {
            display: flex;
            width: 100%;
            margin-right: 40px;
            margin-top: 5px;
            justify-content: end;
            color: white;
        }
        .parentcontainer{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
          
        }
</style>
<body>
    <header class="logobar">
        <div class="container">
            <div class="row">
                <div class="col_1">
                    <a href=""><img src="https://xportsoft.com/assets/img/logo-footer.png" alt=""></a>
                </div>
                <div class="col_2">
                    <div class="span">
                        <div class="sub">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <h4>Drop a line <br> mailto:services@xportsoft.com </h4>
                    </div>
                    <div class="span">
                        <div class="sub">
                            <i class="fa-solid fa-headphones"></i>
                        </div>
                        <h4>Drop a line <br> mailto:services@xportsoft.com </h4>
                    </div>
                    <div class="span">
                        <button id="show-form">Request A Quote</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="banner_content">
        <div class="container">
            <div class="heading">
                <h1 id="heading_one">CRAFTING END-TO-END</h1>
                <h1 id="heading_two">#eCommerceForYou</h1>
            </div>
            <div class="heading">
                <h1 id="heading_three">WE DEVELOP, YOU SELL; LET ‘VISITORS’ HAPPILY BUY! </h1>
            </div>
        </div>
    </div>

    <!-- banner -->
    <div class="banner">
        <div class="container">
            <div class="image">
                <img src="https://xportsoft.com/custom-ecommerce-development-service/images/banner_img.svg" alt="">
            </div>
            <div class="form">
                <div class="form_container">
                    <div class="title">
                        <h3>Make Smart Sales with</h3>
                        <h4>Smarter eCommerce Solution!</h4>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name="name" placeholder="Full Name" minlength="2" maxlength="8" required><br>
                    <input type="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required><br>
                    <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10" required><br>
                    <textarea name="comment" cols="30" rows="3" placeholder="Comment" required></textarea><br>
                    <button type="submit">Get A Quote</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- #! section -->

    <div class="last">
        <div class="container">
            <div class="lines">
                <h1>#1 eCommerce Development Company in UK</h1>
                <h2>Custom eCommerce Solution, #BuiltForYou</h2>
            </div>
            <div class="checks">
                <div class="one">
                    <div><i class="fa-solid fa-square-check"></i>Customisation and Branding</div>
                    <div><i class="fa-solid fa-square-check"></i>Robust Security</div>
                    <div><i class="fa-solid fa-square-check"></i>Scalable and User-Friendly</div>
                    <div><i class="fa-solid fa-square-check"></i>Powered by MERN Stack Technology</div>
                    <div><i class="fa-solid fa-square-check"></i>Diverse Payment Methods</div>
                    <div><i class="fa-solid fa-square-check"></i>Endless Integration Capabilities</div>
                    <div><i class="fa-solid fa-square-check"></i>End-to-End Support</div>
                </div>
            </div>
            <div class="down">
                <div class="start">
                    <h3><a href="">Start Your eCommerce Journey Risk Free!</a></h3>
                </div>
                <div class="contact">
                    <h3><i class="fa-solid fa-cart-shopping"></i><a href="">Contact Now</a></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- skilled in  -->

    <div class="skills">
        <div class="contain">
            <div class="skill_content">
                <h1>As a Top Custom <span class="color_red">eCommerce Solution Provider </span> </h1>
                <p>We’re skilled in</p>
                <div class="devide">
                    <div class="first">
                        <div class="left_divs">
                            <h4>Customising Your Unique Needs </h4>
                            <p>Your business is one-of-a-kind, and so is our approach to
                                eCommerce. We suss out your needs, industry quirks, and target
                                audience to craft a bespoke MERN Stack-powered eCommerce platform that
                                captures your brand and caters to your customers' tastes.</p>
                        </div>
                        <div class="left_divs">
                            <h4>Customising Your Unique Needs </h4>
                            <p>Your business is one-of-a-kind, and so is our approach to
                                eCommerce. We suss out your needs, industry quirks, and target
                                audience to craft a bespoke MERN Stack-powered eCommerce platform that
                                captures your brand and caters to your customers' tastes.</p>
                        </div>
                        <div class="left_divs">
                            <h4>Supporting Seamless Integrations </h4>
                            <p>Efficiency is key in eCommerce. Our custom
                                eCommerce solution seamlessly integrates with
                                your existing tools, from inventory management
                                to payment gateways. Hence, you can say goodbye to
                                manual data entry and hello to efficiency.</p>
                        </div>
                        <div class="left_divs">
                            <h4>MERN Stack Technology </h4>
                            <p>Experience modern, efficient, and scalable
                                eCommerce with our MERN stack-powered solution.
                                We’ll bloom your e-store with all essentials,
                                including MongoDB – Known for flexibility,
                                Express.js – simplifying things, React – creating stunning UI
                                options, and Node.js – needs no explanation!</p>
                        </div>
                    </div>


                    <div class="second">
                        <img class="middle-img"
                            src="https://xportsoft.com/custom-ecommerce-development-service/images/Group-579078.png"
                            alt="">
                    </div>


                    <div class="third">
                        <div class="right_divs">
                            <h4>Facilitating SEO Excellence </h4>
                            <p>With the amalgamation of various tools
                                and SEO strategies, our eCommerce solution makes it possible
                                for you to scale and expand the reach and potential of your business,
                                from a simple web solution to a sophisticated eCommerce portal.</p>
                        </div>
                        <div class="right_divs">
                            <h4>Low Maintenance Costs </h4>
                            <p>We value cost-effectiveness in addition to all of our extensive
                                eCommerce offerings. Because of the low maintenance expenses of
                                our custom eCommerce solution, you can run your eCommerce business
                                profitably and without breaking the bank.</p>
                        </div>
                        <div class="right_divs">
                            <h4>Mobile-friendly Interface </h4>
                            <p>Our eCommerce solution's mobile adaptability lets customers
                                shop hassle-free. This means that potential customers may browse
                                your online store and make purchases here, there, and everywhere – no
                                matter whether they're at home or on the move.</p>
                        </div>
                        <div class="right_divs">
                            <h4>Finally, Helping You Grow</h4>
                            <p>Your growth is the driving force behind our unique custom
                                eCommerce solution. We architect your success rather than merely
                                creating websites. With our specialised strategy, you can confidently
                                grow your business since you know that your online store is prepared for the road ahead.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Request -->

    <section class="request">
        <div class="container">
            <div class="request_container">
                <div class="req_one">
                    <p>Get Your Full-fledged eCommerce Website Ready, Just <span class="color-blue-1">in 2 WEEKS!</span>
                    </p>
                </div>
                <div class="req_two">
                    <p><a href="">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                            Request a Call Back Now
                        </a></p>
                </div>
            </div>
        </div>
    </section>



    <!-- modal popup -->
    <div class="modal" id="modal">
        
            <div class="form">
                <div class="form_container">
                    <div class="title">
            

                        <h3>Make Smart Sales with <span><i id="closed-form" class="fa-solid fa-x"></i></span></h3>
                        <h4>Smarter eCommerce Solution!</h4>
                    </div>
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="text" name="name" placeholder="Full Name" minlength="2" maxlength="8" required><br>
                    <input type="email" name="email" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required><br>
                    <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10" required><br>
                    <textarea name="comment" cols="30" rows="3" placeholder="Comment" required></textarea><br>
                    <button type="submit">Get A Quote</button>
                </form>
                    
                </div>
            </div>
           
    </div>
    <script>
         window.onload = function () {
            modal.style.display = 'none';
        };
        // let showForm= document.getElementById("showForm");
        let showForm = document.getElementById("show-form");
        console.log(showForm);
        let modal= document.getElementById("modal");

        let closedForm= document.getElementById("closed-form");

        closedForm.addEventListener('click', ()=>{
         modal.style.display='none';
        })

        showForm.addEventListener('click', ()=>{
            modal.style.display='block';

        })

    </script> 


<div class="one">
    <div class="box"><iframe width="100%" height="345" src="https://www.youtube.com/embed/gTo-lPOGPdg?autoplay=1&mute=1"></iframe></div>
    <div class="box"><iframe width="100%" height="345" src="https://www.youtube.com/embed/YqKYpgZ9FWU?autoplay=1&mute=1"></iframe></div>
    <div class="box"><iframe width="100%" height="345" src="https://www.youtube.com/embed/RPTfC_XQa58?autoplay=1&mute=1"></iframe></div>
</div>
<div class="two">
    <div class="box"><iframe width="100%" height="345" src="https://www.youtube.com/embed/PwwQX7S3rio?autoplay=1&mute=1"></iframe></div>
    <div class="box"><iframe width="100%" height="345" src="https://www.youtube.com/embed/ixr7ZYgH_6I?autoplay=1&mute=1"></iframe></div>
</div>
<div class="three">
    <div class="box"><iframe width="100%" height="545" src="https://www.youtube.com/embed/Y1J9_9-vNcU?autoplay=1&mute=1"></iframe></div>
</div>

</body>
</html>