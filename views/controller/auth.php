<?php

    session_name('perpus_digital');
    session_start();

    include "controller/connect.php";

    if ($mysqli->connect_error) {
        die("Koneksi ke database gagal :" . $mysqli->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = $mysqli->real_escape_string($_POST['password']);

        $query_user = "SELECT * FROM user WHERE username = '$username'";
        $result_user = $mysqli->query($query_user);

        if ($result_user && $result_user->num_rows == 1) {
            $row_user = $result_user->fetch_assoc();

            if (password_verify($password, $row_user['password'])) {

                session_regenerate_id(true);
                $_SESSION['id_user']            = $row_user['id_user'];
                $_SESSION['username']           = $row_user['username'];
                $_SESSION['nama_user']          = $row_user['nama_user'];
                $_SESSION['level']              = $row_user['level'];
                $_SESSION['foto']               = $row_user['foto'];

                if ($row_user['level'] == 'Admin') {
                    header("Location: /project/views/admin/index");
                }
                exit();
            } else {
                $error_message = "Username atau Password yang anda masukan salah.";
            }

        } 
        
        else {

            $query_anggota = "SELECT * FROM anggota WHERE nis = '$username'";
            $result_anggota = $mysqli->query($query_anggota);

            if ($result_anggota && $result_anggota->num_rows == 1) {
                $row_anggota = $result_anggota->fetch_assoc();

                if (password_verify($password, $row_anggota['password'])) {

                    session_regenerate_id(true);
                    $_SESSION['id_siswa']           = $row_anggota['id_siswa'];
                    $_SESSION['nis']                = $row_anggota['nis'];
                    $_SESSION['nama_anggota']       = $row_anggota['nama_anggota'];
                    $_SESSION['alamat']             = $row_anggota['alamat'];
                    $_SESSION['no_telp']            = $row_anggota['no_telp'];
                    $_SESSION['foto']               = $row_anggota['foto'];
                    $_SESSION['level']              = $row_anggota['level'];

                    header("Location: /project/views/user/index");
                    exit();
                } else {
                    $error_message = "Username atau Password yang anda masukan salah.";
                }
            } else {
                $query_guru = "SELECT * FROM guru WHERE nip = '$username'";
                $result_guru = $mysqli->query($query_guru);

                if ($result_guru && $result_guru->num_rows == 1) {
                    $row_guru = $result_guru->fetch_assoc();

                    if (password_verify($password, $row_guru['password'])) {

                        session_regenerate_id(true);
                        $_SESSION['id_guru']            = $row_guru['id_guru'];
                        $_SESSION['nip']                = $row_guru['nip'];
                        $_SESSION['nama_guru']          = $row_guru['nama_guru'];
                        $_SESSION['alamat']             = $row_guru['alamat'];
                        $_SESSION['no_telp']            = $row_guru['no_telp'];
                        $_SESSION['foto']               = $row_guru['foto'];
                        $_SESSION['level']              = $row_guru['level'];

                        header("Location: /project/views/guru/index");
                        exit();
                    } else {
                        $error_message = "Username atau Password yang anda masukan salah.";
                    }
                } else {
                    $error_message = "Username atau Password yang anda masukan salah.";
                }
            }
        }
    }
?>