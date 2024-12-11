<?php include(__DIR__ . '/../layouts/header.php'); ?>
<!-- Navbar giống file home.html -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<div class="container mt-5">
    <h1>About Game Store</h1>
    <p>Welcome to the <strong>Game Store</strong>, your one-stop destination for the best gaming experiences! We provide a wide selection of games for all types of players, from action-packed adventures to relaxing puzzle games. Whether you're a seasoned gamer or just getting started, we have something for you.</p>

    <h2>Our Mission</h2>
    <p>Our mission is simple: to offer players the best games with great quality, diverse gameplay, and engaging experiences. We aim to foster a community where gamers can connect, share their experiences, and enjoy their favorite games.</p>

    <h2>What We Offer</h2>
    <ul>
        <li><strong>Wide Game Selection:</strong> Choose from a variety of genres including action, RPG, strategy, sports, and more.</li>
        <li><strong>Exclusive Deals:</strong> Take advantage of our frequent sales, discounts, and exclusive game bundles.</li>
        <li><strong>Easy Access:</strong> Download or stream your favorite games directly from our platform without any hassle.</li>
        <li><strong>Community Features:</strong> Connect with other players, participate in challenges, and share your achievements.</li>
    </ul>

    <h2>Our Team</h2>
    <p>Our dedicated team of game enthusiasts, developers, and customer support staff work hard to provide you with the best experience possible. We value your feedback and are constantly striving to improve and evolve our platform.</p>

    <h2>Stay Connected</h2>
    <p>Follow us on social media to stay up to date with new releases, sales, and community events:</p>
    <ul>
        <li>Facebook: <a href="https://www.facebook.com/gamestore" target="_blank">facebook.com/gamestore</a></li>
        <li>Twitter: <a href="https://www.twitter.com/gamestore" target="_blank">twitter.com/gamestore</a></li>
        <li>Instagram: <a href="https://www.instagram.com/gamestore" target="_blank">instagram.com/gamestore</a></li>
    </ul>
</div>
<style>
    /* CSS cho trang About Game Store với nền đen và chữ trắng */

    body {
        background-color: #121212;
        /* Nền đen */
        color: white;
        /* Chữ trắng */
        font-family: Arial, sans-serif;
        /* Font chữ dễ đọc */
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: white;
        /* Chữ trắng */
        text-align: center;
        margin-bottom: 1rem;
    }

    h2 {
        font-size: 2rem;
        color: #ddd;
        /* Chữ trắng nhạt cho tiêu đề phụ */
        margin-top: 2rem;
        border-bottom: 2px solid #444;
        /* Đường kẻ màu xám để phân tách */
        padding-bottom: 0.5rem;
    }

    p {
        font-size: 1.1rem;
        color: #ccc;
        /* Chữ xám sáng cho đoạn văn */
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    ul {
        list-style-type: none;
        padding-left: 0;
    }

    ul li {
        font-size: 1.1rem;
        color: #ccc;
        /* Chữ xám sáng cho danh sách */
        margin-bottom: 0.8rem;
    }

    a {
        color: #1e90ff;
        /* Màu xanh cho liên kết */
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    ul li a {
        color: #fff;
        /* Liên kết có màu trắng */
    }

    ul li a:hover {
        color: #1e90ff;
        /* Màu xanh khi hover */
    }

    footer {
        text-align: center;
        padding: 20px;
        background-color: #222;
        /* Nền footer tối */
        color: #aaa;
        /* Chữ footer xám */
    }
</style>
<?php include(__DIR__ . '/../layouts/footer.php'); ?>