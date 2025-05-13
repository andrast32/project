<?php

    if (isset($_POST['id_guru'])) {
        $id_guru        = $_POST['id_guru'];
        $new_password   = password_hash('guru kebon dalem', PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("UPDATE guru SET password = ? WHERE id_guru = ?");
        $stmt->bind_param("si", $new_password, $id_guru);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }

        $stmt->close();
    }
?>