<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Accommodation</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            background-image: url("pics/futuristic-background-design_23-2148503793.avif");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 4px;
            height:125px;
        } 
        header h1{
            margin:0;
            padding:0;
            font-size: 27px;
        }
        
        nav ul {
            list-style-type: none;
            padding: 0;
            height:100%;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            color: #fff;
            text-decoration: none;
        }
        main {
            padding: 20px;
        }
        .room-card {
            width: 45%; 
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            display: inline-block; 
            vertical-align: top; 
        }
        .room-card h3 {
            margin-top: 0;
        }
        .room-card img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;  
            margin-bottom: 10px;
        }
        .room-card p {
            margin-bottom: 10px;
        }
        .room-card a {
            display: inline-block;
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        h2 {
        color: #fff;}
        .room-card a:hover {
            background-color: #555;
        }
        .image-carousel {
            display: block; 
        }
        
        footer {
            background-color: #f8f9fa; 
            color: #333;
            padding: 5px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }
        footer p {
            margin: 0;
            text-align: left;
            flex: 1 1 100%; 
            

        }
        footer a {
            color: #333;
            text-decoration: none;
            margin-left: 10px;
        }
        .social-media-links {
            flex: 1 1 100%; 
            text-align: right;
            margin-top: 10px;
        }
        .footer-links {
            flex: 1 1 100%; 
            text-align: left;
            margin-top: 10px;
        }
        .footer-links a {
            margin-right: 10px;
        }
        .social-media-links a {
            margin-left: 10px;
            font-size: 24px;
        }
        .social-media-links a:hover {
            color: #ccc;
        }
        .fab:hover {
            color: #0056b3; 
        }
        .copyright {
            flex: 1 1 100%; 
            text-align: center;
            margin-top: 20px;
        }

        #scrolling-text-container {
            overflow: hidden;
            position: relative;
            height: 50px;  
        }

        #scrolling-text {
            position: absolute;
            white-space: nowrap;
            animation: scroll-text 10s linear infinite;
        }

        @keyframes scroll-text {
            0% { left: 100%; }
            100% { left: -100%; }
        }
        #load-more-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        #load-more-btn:hover {
            background-color: #555;
        }

    </style>
</head>
<body>
    <header>
        <h1>Welcome to PG Accommodation</h1>
        <div id="scrolling-text-container">
            <p id="scrolling-text">
                "Welcome to PG Accommodation! We're glad you're here. We're always ready to assist you for your convenience. There will be no shortage in our service to make your trip memorable.."
            </p>
        </div>
        <nav>
            <ul>
                <li><a href="home.php">Home </a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="services.php">Services</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="login.php">Dashboard</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="container">
            <h2>Available Rooms</h2>
            <div class="room-card" id="ac-room">
                <h3>AC Room</h3>
                <div class="image-carousel">
                    <img src="pics/download (2).jpeg" alt="AC Room 1">
                    <img src="pics/download (3).jpeg" alt="AC Room 2">
                    <img src="pics/download (4).jpeg" alt="AC Room 3">
                    <img src="pics/download (1).jpeg" alt="AC Room 4">
                    <img src="pics/images (5).jpeg" alt="AC Room 5">
                </div>
                <p>Description of AC Room: Our AC rooms are equipped with modern amenities to ensure a comfortable stay during your time with us.</p>
                <a href="services.php?type=ac">Book Now</a>  
                <a href="about.php#ac-room" class="read-more">Read More</a>
            </div>
            <div class="room-card" id="non-ac-room">
                <h3>Non-AC Room</h3>
                <div class="image-carousel">
                    <img src="pics/images (1).jpeg" alt="Non-AC Room 1">
                    <img src="pics/images (2).jpeg" alt="Non-AC Room 2">
                    <img src="pics/images (3).jpeg" alt="Non-AC Room 3">
                    <img src="pics/images (4).jpeg" alt="Non-AC Room 4">
                    <img src="pics/images (5).jpeg" alt="Non-AC Room 5">
                </div>
                <p>Description of Non-AC Room: Our Non-AC rooms provide a cozy atmosphere and all necessary facilities for a pleasant stay at affordable prices.</p>
                <a href="services.php?type=non_ac">Book Now</a>
                <a href="about.php#non-ac-room" class="read-more">Read More</a>
            </div>
        </div>
 
        <section id="gallery">
            <h2>Gallery</h2>
                
            <div class="image-gallery">
                <?php
                include 'connection.php';

                $sql = "SELECT * FROM photos";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['photo_data']) . '" alt="' . $row['photo_type'] . '">';
                    }
                } else {
                    echo "No images found.";
                }

                $conn->close();
                ?>
            </div>
            <button id="load-more-btn">Load More</button>
        </section>
    </main>
    <footer>
        <div class="footer-links">
            <a href="home.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="services.php">Services</a>
            <a href="contact.php">Contact Us</a>
        </div>
        <div class="social-media-links">
            <a href="https://www.instagram.com/your_instagram_id" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/your_facebook_id" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.linkedin.com/in/your_linkedin_id" target="_blank"><i class="fab fa-linkedin-in"></i></a>
        </div>
        <div class="contact-info">
            <p>Address:<br>
            100 xportsoft<br>
            Ambala Cantt<br>
            Haryana</p>
            <p>Email: info@example.com<br>
            Phone: +123456789</p>
        </div>
        <div class="copyright">
            <p>&copy; 2024 PG Accommodation. All Rights Reserved.</p>
        </div>
    </footer>
    <script>
        
        const scrollingText = document.getElementById('scrolling-text');
        scrollingText.style.animation = "scroll-text 10s linear infinite";
        // console.log("scrollingText",scrollingText);

    
        const roomCards = document.querySelectorAll('.room-card');
        roomCards.forEach(roomCard => {
            const imageCarousel = roomCard.querySelector('.image-carousel');
            const images = imageCarousel.querySelectorAll('img');
            let currentIndex = 0;

            function showSlide(index) {
                images.forEach((image, i) => {
                    if (i === index) {
                        image.style.display = 'block';
                    } else {
                        image.style.display = 'none';
                    }
                });
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % images.length;
                showSlide(currentIndex);
            }

            showSlide(currentIndex);
            setInterval(nextSlide, 2000);
        });
        const loadMoreBtn = document.getElementById('load-more-btn');
        let start = 3; 
        loadMoreBtn.addEventListener('click', function() {
            fetch('load_image.php?start=' + start)
                .then(response => response.text())
                .then(data => {
                    const gallery = document.querySelector('.image-gallery');
                    gallery.innerHTML += data; 
                    start += 3; 
                })
                .catch(error => console.error('Error loading images:', error));
        });

    </script>
</body>
</html>
