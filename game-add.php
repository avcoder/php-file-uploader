<?php
// ignore all this php code from lines 2-12.
// It's simply here so that the html page
// below won't error out due to calls to php variables
$errors = [];
$conn = null;

function db_queryAll($sql, $conn) {
    $genres = [];
    $genres[0]['genre'] = "Action";
    $genres[1]['genre'] = "Racing";
    $genres[2]['genre'] = "Puzzle";
    return $genres;
}

$title_tag = "Add Game";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title_tag ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
<div class="container">


    <h1 class="text-center mt-5">Add Game <i class="bi bi-joystick"></i></h1>

    <div class="row mt-5 ms-1">
        <form class="row justify-content-center mb-5" action="game.php" method="POST" novalidate>
            <div class="col-12 col-md-6">

                <div class="row mb-4">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input autofocus required class="<?= (isset($errors['title']) ? 'is-invalid ' : ''); ?> form-control form-control-lg" type="text" name="title" placeholder="Title" value="<?= $title ?? ''; ?>">
                            <label class="col-2 col-form-label" for="title">Title</label>
                            <p class="text-danger"><?= $errors['title'] ?? ''; ?></p>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 ">
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input inputmode="numeric" pattern="[0-9]{4}" title="Enter a 4 digit year"
                                class="<?= (isset($errors['year']) ? 'is-invalid ' : ''); ?>form-control form-control-lg" type="text" name="year" placeholder="2021" value="<?= $year ?? ''; ?>">
                            <label class="col-2 col-form-label" for="year">Year</label>
                            <p class="text-danger"><?= $errors['year'] ?? ''; ?></p>
                        </div>
                    </div>
                </div> 

                <div class="row mb-4">
                    <div class="col">
                        <div class="form-floating">
                            <select name="genre" id="genre" class="form-select form-select-lg" style="height:70px;">
                                <?php 
                                    $sql = "SELECT genre FROM genres ORDER BY genre";
                                    $genres = db_queryAll($sql, $conn);
                                    
                                    foreach ($genres as $eachgenre) {
                                        echo "<option value=" . $eachgenre["genre"] . ">" . ucfirst($eachgenre["genre"]) . "</option>";
                                    }
                                ?>
                            </select>
                            <label class="col-form-label" for="genre">Genre</label>
                        </div>
                    </div>                    
                </div>


                <div class="row mb-4 ">
                    <div class="col">
                    
                        <div class="form-floating mb-3">
                            <input required pattern="https?:\/\/.+\..+"
                                title="Please enter a url beginning with http:// or https://" class="<?= (isset($errors['url']) ? 'is-invalid ' : ''); ?>form-control form-control-lg"
                                type="text" name="url" placeholder="https://" value="<?= $url ?? ''; ?>">
                            <label class="col-2 col-form-label" for="url">Url</label>
                            <p class="text-danger"><?= $errors['url'] ?? ''; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center col-12 col-md-9">
                <button class="btn btn-success btn-lg">Submit</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>