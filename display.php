<?php
include("backend/fetch_db.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UP-DOWN</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
        body {
            background-color: #eeeeee;
        }
    </style>

</head>

<body>

    <div class="container">
        <div class="mt-4">
            <h1 class="text-center">UP-DOWN</h1>
            <hr>
            <a class="btn btn-outline-dark" href="index.php">Home</a>
            <hr>
            <div class=" mt-4">
                <a class="btn btn-outline-dark" href="backend/download.php">Download In CSV</a>
                <hr>
                <h4>Showing From Database</h4>
                <table class="table table-striped table-hover mt-4">
                    <thead>
                        <tr>
                            <th>S.N</th>
                            <th>Name</th>
                            <th>UID</th>
                            <th>Date</th>
                            <th>Time</th>
                    </thead>
                    <tbody>
                        <?php
                        if (is_array($fetchData)) {
                            $sn = 1;
                            foreach ($fetchData as $data) {
                        ?>
                                <tr>
                                    <td><?php echo $sn; ?></td>
                                    <td><?php echo $data['name'] ?? ''; ?></td>
                                    <td><?php echo $data['user_id'] ?? ''; ?></td>
                                    <td><?php echo $data['date'] ?? ''; ?></td>
                                    <td><?php echo $data['time'] ?? ''; ?></td>
                                </tr>
                            <?php
                                $sn++;
                            }
                        } else { ?>
                            <tr>
                                <td colspan="5">
                                    <?php echo $fetchData; ?>
                                </td>
                            <tr>
                            <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>