<?php  

//index.php

$conn = new PDO("mysql:host=localhost;mysql:charset=utf8;dbname=csdl_clb", "root", "");

$query = "SELECT year FROM chart_data GROUP BY year DESC";

$statement = $conn->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

?>  
<!DOCTYPE html>  
<html>  
    <head>  
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
        <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
  
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

        <style>
            <?php include ('css/style-main.css'); ?>
            body{
                background: #1e2230;
            }
            
            #chart_area{
                margin: auto;
                
            }
            .col-md-9 a{
                margin-right: 5px;
                font-size: 16px;

            }
            @media only screen and (max-width: 500px) {
              
            }  
            @media only screen and (max-width: 360px) {
              
            }  
        </style>
    </head>  
    <body> 
        <br /><br />
        <div class="container">  
            
            
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                            <a href="index.php">Trang chủ</a>
                            <a href="admin.php">Quản trị viên</a>
                        </div>
                        <div class="col-md-3">
                            <select name="year" class="form-control" id="year">
                                <option value="">Chọn năm</option>
                            <?php
                            foreach($result as $row)
                            {
                                echo '<option value="'.$row["year"].'">'.$row["year"].'</option>';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-body" style="">
                    <div id="chart_area" style=""></div>
                </div>
            </div>
        </div>  
    </body>  
</html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawChart);

function load_monthwise_data(year, title)
{
    var temp_title = title + ' '+year+'';
    $.ajax({
        url:"process/fetch_chart.php",
        method:"POST",
        data:{year:year},
        dataType:"JSON",
        success:function(data)
        {
            drawMonthwiseChart(data, temp_title);
        }
    });
}

function drawMonthwiseChart(chart_data, chart_main_title)
{
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Tháng');
    data.addColumn('number', 'Truy cập');
    $.each(jsonData, function(i, jsonData){
        var month = jsonData.month;
        var view = parseFloat($.trim(jsonData.view));
        data.addRows([[month, view]]);
    });
    var options = {
        title:chart_main_title,
        hAxis: {
            title: "Tháng"
        },
        vAxis: {
            title: 'Tổng lượt truy cập'
        },
         width: $(document.getElementById('chart_area')).width(),
        height: $(document.getElementById('chart_area')).height()

    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}

</script>

<script>
    
$(document).ready(function(){

    $('#year').change(function(){
        var year = $(this).val();
        if(year != '')
        {
            load_monthwise_data(year, 'Thống kê của năm');
        }
    });
});

</script>