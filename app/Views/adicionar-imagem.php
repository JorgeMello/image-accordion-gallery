<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if files were uploaded
    if (isset($_FILES['image_name']['name'])) {
        $image_name = $_FILES['image_name']['name'];
        $image_tmp = $_FILES['image_name']['tmp_name'];
        $image_size = $_FILES['image_name']['size'];
        $image_type = $_FILES['image_name']['type'];

        dd($image_name, $image_tmp, $image_size, $image_type);
        $target_directory = '<?= base_url('public/imagens/') ?>'; 

        $unique_filename = uniqid() . '_' . $image_name;

        if (!is_dir($target_directory)) {
            mkdir($target_directory, 0777, true);
        }

        if (move_uploaded_file($image_tmp, $target_directory . $unique_filename)) {

            $stmt = $conn->prepare("INSERT INTO imagens VALUES (:unique_filename)");
            $stmt->bindParam(':unique_filename', $unique_filename);
            $stmt->execute();

            header('Location: <?= base_url() ?>');
        } else {

            echo "Ocorreu um erro no envio da imagem.";
        }
    } else {
        echo "Selecione uma imagem para enviar.";
    }
}
?>
