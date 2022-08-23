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
            <div class="mt-4">

                <div class="row">
                    <div class="col-8">
                        <form action="backend/upload.php" method="post" enctype="multipart/form-data">
                            <h6>Choose CSV File</h6>
                            <div class="input-group">
                                <input type="file" class="form-control" id="fileUpload" name="file" required onchange="Upload()">
                                <button class="btn btn-warning" type="button" id="upload" onclick="Upload()" id="inputGroupFileAddon04">Show In Table</button>
                            </div>
                            <input type="submit" name="submit" class="mt-4 btn btn-outline-danger btn-sm" value="Upload In Database" />
                            <div class="alert alert-warning mt-1" role="alert">
                                Check(<b>Show In Table</b>) CSV File Before <b>Upload.</b>
                            </div>
                        </form>
                    </div>
                </div>

                <hr>
                <div id="csv_table"></div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript">
        function Upload() {
            var fileUpload = document.getElementById("fileUpload");
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
            if (regex.test(fileUpload.value.toLowerCase())) {
                if (typeof(FileReader) != "undefined") {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        let tableH = "<h4>Showing From CSV File</h4><table class='table text-center table-striped table-hover'><tbody>";
                        var rows = e.target.result.split("\n");
                        for (var i = 0; i < rows.length; i++) {
                            var cells = rows[i].split(",");
                            if (cells.length > 1) {
                                tableH += "<tr>";
                                for (var j = 0; j < cells.length; j++) {
                                    tableH += "<td>" + cells[j] + "<td/>";
                                }
                                tableH += "</tr>\n";
                            }
                        }
                        tableH += "</tbody></table>";
                        var div = document.getElementById('csv_table');
                        div.innerHTML = tableH;
                    }
                    reader.readAsText(fileUpload.files[0]);
                } else {
                    alert("This browser does not support HTML5.");
                }
            } else {
                alert("Please upload a valid CSV file.");
            }
        }
    </script>
</body>

</html>