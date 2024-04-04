<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicativo Image Accordion Gallery usando PHP e MySQL</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-image: linear-gradient(to left top, blue, red);
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .alert>h1 {
            font-weight: bold;
        }

        .gallery-container {
            margin: auto;
            top: 0;
            bottom: 0;
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 550px;
        }

        .item {
            position: relative;
            height: 100%;
            cursor: pointer;
        }

        .item>button {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>

<body>

    <div class="alert alert-success text-center p-5" role="alert">
        <h1>GALERIA DE IMAGENS EM CODEIGNITER 4</h1>
        <button class="btn btn-success" data-target="#addImageModal" data-toggle="modal">Adicionar Imagem</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addImageModal" tabindex="-1" aria-labelledby="addImage" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addImage">Adicionar uma Imagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('incluirimagem') ?>" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="image_name">Selecione a Imagem:</label>
                            <input type="file" class="form-control-file" id="imageName" name="image_name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="main">

        <div class="gallery-container">
            <?php

            $conn = new PDO("mysql:host=localhost;dbname=imagem_galeria", "root", "");



            $stmt = $conn->prepare("SELECT * FROM imagens");
            $stmt->execute();

            $result = $stmt->fetchAll();
            //dd($result);
            foreach ($result as $row) {
                $imageId = $row['id'];
                $image = $row['nome'];
            ?>
                <div class="item">
                
                    <img src="<?= base_url('public/imagens/') . $image ?>" alt="">
                    <button class="btn btn-dark" style="display: none;" onclick="deleteImage(<?= $imageId ?>)">x</button>
                </div>
            <?php
            }
            ?>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

    <!-- Script JS -->
    <script src="./assets/script.js"></script>


    <script>
        let deviceType = "";
        let events = {
            mouse: {
                start: "mouseover",
                end: "mouseout",
            },
            touch: {
                start: "touchstart",
                end: "touchend",
            },
        };

        const isTouchDevice = () => {
            try {
                document.createEvent("TouchEvent");
                deviceType = "touch";
                return true;
            } catch (e) {
                deviceType = "mouse";
                return false;
            }
        };

        isTouchDevice();
        const items = document.querySelectorAll(".item");

        items.forEach((item, index) => {
            let img = item.querySelector('.item img');
            let imgBtn = item.querySelector('.item button');
            img.style.width = "100%";
            img.style.height = "100%";
            img.style.objectFit = "cover";

            item.style.transition = "flex 0.8s ease";

            item.addEventListener(events[deviceType].start, () => {
                item.style.flex = "4";
                imgBtn.style.display = '';
            });
            item.addEventListener(events[deviceType].end, () => {
                imgBtn.style.display = 'none';
                item.style.flex = "1";
            });
        });


        function deleteImage(id) {
            if (confirm("Do you want to delete this image?")) {
                window.location = "./endpoint/delete-image.php?image=" + id;
            }
        }
    </script>
</body>

</html>