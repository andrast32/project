<?php 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['kelas'])
            && isset($_POST['indeks_kelas'])
            && isset($_POST['id_guru'])) {

                $kelas          = $_POST['kelas'];
                $indeks_kelas   = $_POST['indeks_kelas'];
                $id_guru        = $_POST['id_guru'];

                $stmt = $mysqli->prepare("INSERT INTO data_kelas (kelas, indeks_kelas, id_guru) VALUES (?,?,?)");
                $stmt->bind_param("sss", $kelas, $indeks_kelas, $id_guru);

                if ($stmt->execute()) {
                    echo "
                        <script>
                            Swal.fire({
                                icon                :   'success',
                                title               :   'Berhasil',
                                text                :   'Data kelas berhasil disimpan!',
                                showConfirmButton   :   false,
                                timer               :   1500
                            }).then(function() {
                                window.location.href = '?kelas=kelas';
                            });
                        </script>"
                    ;
                } else {
                    echo "
                        <script>
                            Swal.fire({
                                icon                :   'error',
                                title               :   'Oops...',
                                text                :   'Data kelas gagal disimpan!',
                                showConfirmButton   :   false,
                                timer               :   1500
                            }).then(function() {
                                window.location.href = '?kelas=kelas';
                            });
                        </script>"
                    ;
                }
                $stmt->close();
            } else {
                echo "
                    <script>
                        Swal.fire({
                            icon                :   'error',
                            title               :   'Oops...',
                            text                :   'Data tidak lengkap!',   
                            showConfirmButton   :   false,
                            timer               :   1500
                        }).then(function() {
                            window.location.href = '?kelas=kelas';
                        });
                    </script>"
                ;
            }
    } else {
        echo "
            <script>
                Swal.fire({
                    icon                :   'error',
                    title               :   'Oops...',
                    text                :   'Data tidak lengkap!',
                    showConfirmButton   :   false,
                    timer               :   1000
                }).then(function() {
                    window.location.href = '?kelas=kelas';
                });
            </script>"
        ;
    }
?>