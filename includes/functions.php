<?php
function loginUser($conn, $username, $password) {
    $stmt = $conn->prepare("SELECT id, password FROM usuario WHERE username = ?");
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            return $user['id'];
        }
    }
    return false;
}

function registerUser($conn, $nombre, $username, $password) {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $stmt = $conn->prepare("INSERT INTO usuario (nombre, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $nombre, $username, $hashedPassword);
    return $stmt->execute();
}
?>
