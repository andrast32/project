<?php

    if (isset($_POST['id_siswa'])) {
        $id_siswa       = $_POST['id_siswa'];
        $new_password   = password_hash('siswa kebon dalem', PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("UPDATE anggota SET password = ? WHERE id_siswa = ?");
        $stmt->bind_param("si", $new_password, $id_siswa);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }

        $stmt->close();
    }
?>