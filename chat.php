<?php
    session_start();
    include "php/config.php";

    if (!isset($_SESSION['unique_id'])) {
        header("location: login.php");
        exit();
    }

    $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);
        $user_fname = $row['fname'];
        $user_lname = $row['lname'];
        $user_image = $row['img'];
        $user_status = $row['status'];
    }

    $user_id = isset($_GET['user_id']) ? mysqli_real_escape_string($conn, $_GET['user_id']) : null;

?>

<?php include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <div class="content">
                    <img src="php/images/<?php echo $user_image; ?>" alt="">
                    <div class="details">
                        <span><?php echo $user_fname . " " . $user_lname; ?></span>
                        <p><?php echo $user_status; ?></p>
                    </div>
                </div>
                <a href="php/logout.php?logout_id=<?php echo $row['unique_id']; ?>" class="users-button Btn-logout">
                    <div class="sign">
                        <svg viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg>
                    </div>
                    <div class="user-btn-text">Logout</div>
                </a>
            </header>
            <div class="search">
                <span class="text">Select a user to start chat</span>
                <input type="text" placeholder="Enter name to search.." id="search-input" />
                <button class="users-button2" id="search-button">
                    <span>
                        <svg viewBox="0 0 24 24" height="24" width="24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.145 18.29c-5.042 0-9.145-4.102-9.145-9.145s4.103-9.145 9.145-9.145 9.145 4.103 9.145 9.145-4.102 9.145-9.145 9.145zm0-15.167c-3.321 0-6.022 2.702-6.022 6.022s2.702 6.022 6.022 6.022 6.023-2.702 6.023-6.022-2.702-6.022-6.023-6.022zm9.263 12.443c-.817 1.176-1.852 2.188-3.046 2.981l5.452 5.453 3.014-3.013-5.42-5.421z"></path>
                        </svg>
                    </span>
                </button>
            </div>
            <div class="users-list"></div> 
        </section>
    </div>

    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php if ($user_id): ?>
                    <?php 
                        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
                        if (mysqli_num_rows($sql) > 0) {
                            $row = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <header>
                        <img src="php/images/<?php echo $row['img'] ?? 'default.png'; ?>" alt="">
                        <div class="details">
                            <span><?php echo $row['fname'] . " " . $row['lname']; ?></span>
                            <p><?php echo $row['status']; ?></p>
                        </div>
                    </header>
                <?php else: ?>
                    <header>
                        <div class="details">
                            <span>Select a User to Chat</span>
                            <p>Select a User to see their Status</p>
                        </div>
                    </header>
                <?php endif; ?>
            </header>
            <div class="chat-box"></div>
            <form action="#" class="typing-area" autocomplete="off">
                <input type="text" name="incoming_id" id="incoming_id" value="<?php echo $user_id; ?>" hidden />
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." />
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>

    <script src="scripts/users.js"></script>
    <script src="scripts/chat.js"></script>
</body> 
</html>