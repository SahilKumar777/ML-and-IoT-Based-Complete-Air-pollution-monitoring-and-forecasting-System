<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script async src="https://static.addtoany.com/menu/page.js"></script>
	<style>
		.my-card {
					border-radius:15px;
					background-color:#0fa75abf;
					margin-top:15px;
					margin-bottom:15px;
					padding:15px;
					border-bottom:2px;
					border-bottom-color:#;
					box-shadow:0 10px 15px rgb(18,235,135,0.15);
					
					}
		.my-widget1-r {
						border-radius:10px;
						background-color:#12fa8f96;
						margin-left:10px;
						padding:10px;
						width:45%;
						}	
        .my-widget1-l {
						border-radius:10px;
						background-color:#12fa8f96;
						margin-right:10px;
						padding:10px;
						width:45%;
						}
		.my-widget2 {
						border-radius:10px;
						background-color:#12fa8f96;
						margin-right:10px;
						padding:10px;
						width:100%;
						}
		.my-widget3 {
						border-radius:10px;
						background-color:#fcebebe0;
						margin:15px;
						padding:0px;
						width:150px;
						box-shadow:0 10px 15px rgb(18,35,25,0.15);
						}
		.my-scroll {
						overflow-x:scroll;
						overflow-y:hidden;
						padding:0px;
						width:100%;
						}	
		.graph 		{
						background-color:#fff;
						}						
	</style>
	<title>Air Pollution</title>
  </head>
  <body>	

	<?php
            date_default_timezone_set("Asia/Calcutta");
            $host="sql205.epizy.com";
            $duser="epiz_33711540";
            $dpaswd="a8CmhA1TPNTiMZ";
            $dname="epiz_33711540_IOT_db";
            
            $db=mysqli_connect($host,$duser,$dpaswd,$dname);
            if(!$db)
            {
                $msg="Unable to connect to database:";
            }
            else
            {
				
			}


	?>
	<div class="float-md-right  sticky-top" style="z-index:1021">		
		<div class="alert alert-danger alert-dismissible shadow m-2" >
			Air Quality Alert 
			<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal">
				Open MESSAGE
			</button>
			<button type="button" class="close" data-dismiss="alert">&times; </button>
		</div>	
	</div>	

	<!-- The Heading-->
	<div class="container-fluid bg-dark ">
		<div class="container-lg p-3 bg-dark text-white ">
		  <h1>Air Quality Prediction</h1>
		  <p>Air Pollution monitoring and Forecasting Using IOT.</p>
		  <div class="float-right d-none">
			<!-- AddToAny BEGIN -->
			<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
				<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
				<a class="a2a_button_twitter"></a>
				<a class="a2a_button_facebook"></a>
				<a class="a2a_button_whatsapp"></a>
				<a class="a2a_button_telegram"></a>
				<a class="a2a_button_google_gmail"></a>
			</div>

			<!-- AddToAny END -->
		  </div>
		</div>	
	</div>
	
	<!-- The Header Navigation -->
	<div class="container-fluid bg-dark sticky-top shadow">
	<div class="container-lg bg-dark ">
		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		
		
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
		</button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
		  <ul class="navbar-nav mr-auto">
			<li class="nav-item">
			  <a class="nav-link" href="/page1.php">Home</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="/page2.php">Reports</a>
			</li>
			<li class="nav-item active">
			  <a class="nav-link" href="/page3.php">About AQI</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link disabled" href="/aqi.apk">Download APP</a>
			</li>
		  </ul>
		</div>
		<form class="form-inline d-none d-sm-block" action="/action_page.php">
			<input class="form-control mr-sm-2" type="text" placeholder="Search">
			<button class="btn btn-success" type="submit">Search</button>
		</form>
		<div class="d-sm-none text-white" >
			<h3>Pollution(AQI)</h3>
		</div>
		</div>
			
		</nav>
	</div>
	</div>

	<!-- AQI Level Chart-->
	<div class="">
		<div class="container-lg p-3 my-3" style="background-color:#8cc5ed94">
			
			<div class="mb-3">
				<h2 >AQI Level Chart</h2>
			</div>
			
			<div class="" id="poll_hr">
				
				<h4 class="">Basic description chart</h4>
				
				<div class=" mb-3">
					<div class="" id="poll_hr_colchart">
						
						<table class="table">
						    <thead class="thead-light">
								<th>Air Quality</th>
								<th>AQI Index</th>
								<th>Description</th>
							</thead>
                            <tr style="background-color:<?php getAqiColor(40);?>">
                                <th>Good</td>
                                <td>0 to 50</td>
								<td>Air quality is satisfactory, and air pollution poses little or no risk.</td>
                            </tr>
                            <tr style="background-color:<?php getAqiColor(90);?>" >
                                <th>Satisfactory</th>
                                <td>50 to 100</td>
								<td>Air quality is acceptable. However, there may be a risk for some people, particularly those who are unusually sensitive to air pollution.</td>
                            </tr>
                            <tr style="background-color:<?php getAqiColor(120);?>">
                                <th>Moderate</th>
                                <td>100 to 150</td>
								<td>Members of sensitive groups may experience health effects. The general public is less likely to be affected.</td>
                            </tr>
                            <tr  style="background-color:<?php getAqiColor(160);?>">
                                <th>Poor</th>
                                <td>150 to 200</td>
								<td>	Some members of the general public may experience health effects; members of sensitive groups may experience more serious health effects.</td>
                            </tr>
							<tr style="background-color:<?php getAqiColor(220);?>">
                                <th>Very Poor</th>
                                <td>200 to 300</td>
								<td>Health alert: The risk of health effects is increased for everyone.</td>
                            </tr>
							<tr  style="background-color:<?php getAqiColor(330);?>">
                                <th>Severe</th>
                                <td>more than 300</td>
								<td>Health warning of emergency conditions: everyone is more likely to be affected.</td>
                            </tr>
							
                        </table>
					</div>	
				</div>
				
			</div>
		</div>
	</div>	
	
    
		<!-- Nav tabs --> 
		<ul class="nav nav-tabs container">
		  <li class="nav-item">
			<a class="nav-link active" data-toggle="tab" href="#good">Good</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#satisfactory">Satisfactory</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#moderate">Modearate</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#poor">Poor</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#vPoor">Very Poor</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" data-toggle="tab" href="#severe">Severe</a>
		  </li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content">
			<?php 
				
				$list=['good','satisfactory','moderate','poor','vPoor','severe'];
                $modalQry="SELECT * FROM aqi_description;";

                if(!$db)
                {
                    $i=0;
                        while($i<6)
						{
							echo"
							<div class=\"tab-pane container ";if($i==0){echo"active \"";}else {echo"fade \"";}
							echo" id=\"".$list[$i]."\">
								<table class='table'>
                            <tr>
                                <th>Description</td>
                                <td>Description of the $list[$i] AQI level</td>
                            </tr>
                            <tr>
                                <th>Who needs Concern</td>
                                <td>What kind of pople need to be concerned</td>
                            </tr>
                            <tr>
                                <th>Health Effects</td>
                                <td>Describes the health effects in this AQI range</td>
                            </tr>
                            <tr>
                                <th>What to do</td>
                                <td>Describes Solutions need to be followed</td>
                            </tr>
                        </table> 
							</div>";
							$i++;
						}
                }
                else
                {
                    if($modalResult=mysqli_query($db,$modalQry))
                    {	$i=0;
                        while($modalData=mysqli_fetch_array($modalResult))
						{
							echo"
							<div class=\"tab-pane container ";if($i==0){echo"active \"";}else {echo"fade \"";}
							echo" id=\"".$list[$i]."\">
								<table class='table'>
                                    <tr>
                                        <th>Description</td>
                                        <td>".$modalData['Description']."</td>
                                    </tr>
                                    <tr>
                                        <th>Who needs Concern</td>
                                        <td>".$modalData['Concern']."</td>
                                    </tr>
                                    <tr>
                                        <th>Health Effects</td>
                                        <td>".$modalData['Effects']."</td>
                                    </tr>
                                    <tr>
                                        <th>What to do</td>
                                        <td>".$modalData['Solution']."</td>
                                    </tr>
                                </table> 
							</div>";
							$i++;
						}
                    }
                }
                 
                    
			?>
		 
		</div>


   </body>
   
   <script>function my_fn(at){	$(at).parent().children("a").removeClass("active");
								$(at).parent().parent().children("button").text($(at).text());
							}
			
	</script>
 
   
   <!-- The Pollution chart-->
   <script type="text/javascript">
	
	google.charts.setOnLoadCallback(drawChart1);
	google.charts.setOnLoadCallback(drawChart2);
	
	// Draw the chart and set the chart values
	function drawChart1() {
	  var data = google.visualization.arrayToDataTable([
			["hour", "AQI", { role: "style" } ],
			["Copper", 8.94, "#b87333"],
			["Silver", 10.49, "silver"],
			["Gold", 19.30, "gold"],
			["Platinum", 21.45, "color: #e5e4e2"],
			["sahil",25.33,"color:#123456"]
                ,["00:00:00",270,"#fcac34"],["01:00:00",254,"#fcac34"],["02:00:00",223,"#fcac34"],["03:00:00",199,"#ffe52b"],["04:00:00",178,"#ffe52b"],["05:00:00",182,"#ffe52b"],["06:00:00",195,"#ffe52b"],["07:00:00",208,"#fcac34"],["08:00:00",238,"#fcac34"],["09:00:00",280,"#fcac34"],["10:00:00",268,"#fcac34"],["11:00:00",200,"#fcac34"],["12:00:00",165,"#ffe52b"],["13:00:00",152,"#ffe52b"],["14:00:00",163,"#ffe52b"],["15:00:00",165,"#ffe52b"],["16:00:00",161,"#ffe52b"],["17:00:00",200,"#fcac34"],["18:00:00",280,"#fcac34"],["19:00:00",321,"#fc5034"],["20:00:00",352,"#fc5034"],["21:00:00",357,"#fc5034"],["22:00:00",318,"#fc5034"],["23:00:00",213,"#fcac34"]                
            
		  ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Air Quality Index (AQI) Level",
        width: 1200,
        height: 300,
        bar: {
		groupWidth: "90%"},
        legend: { position: "none" },
		
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("poll_hr_colchart"));
      chart.draw(view, options);
	}

	// Draw the chart and set the chart values
	function drawChart2() {
	  var data = google.visualization.arrayToDataTable([
			["Date", "AQI", { role: "style" } ],
			["21/11", 8.94, "#b87333"],
			["22/11", 10.49, "silver"],
			["23/11", 19.30, "gold"],
			["24/11", 21.45, "color: #e5e4e2"]
		  ]);


		  var view = new google.visualization.DataView(data);
		  view.setColumns([0, 1,
						   { calc: "stringify",
							 sourceColumn: 1,
							 type: "string",
							 role: "annotation" },
						   2]);

		  var options = {
			title: "Air Quality Index (AQI) Level",
			width: "100%",
			height: 300,
			bar: {groupWidth: "95%"},
			legend: { position: "none" },
		  };
		  var chart = new google.visualization.ColumnChart(document.getElementById("poll_dly_colchart"));
		  chart.draw(view, options);
	}

</script>
 
    <?php 
        function getAqiColor(float $aqi){
            if($aqi<50){
                echo '#08f610';
            }
            elseif($aqi<100){
                echo '#dcf608';
            }
            elseif($aqi<150){
                echo '#ffe52b';
            }
            elseif($aqi<200){
                echo '#fcac34';
            }
            elseif($aqi<300){
                echo '#fc5034';
            }
            elseif($aqi<500){
                echo '#c60f0f';
            }
            else{
                echo '#615f5e';
            }
        }
        
        function getAQ(float $aqi){
            if($aqi<50){
                return 'Good';
            }
            elseif($aqi<100){
                return 'Satisfactory';
            }
            elseif($aqi<150){
                return 'Moderate';
            }
            elseif($aqi<200){
                return 'Poor';
            }
            elseif($aqi<300){
                return 'Very Poor';
            }
            elseif($aqi<500){
                return 'Severe';
            }
            else{
                return 'Inadequate';
            }
        }
    ?>

	</html>
