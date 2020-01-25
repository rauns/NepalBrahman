<?php
require_once("Rate.php");
$rate = new Rate();
$result = $rate->getAllPost();
?>
<HTML>
<HEAD>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
<TITLE>PHP Dynamic Star Rating using jQuery</TITLE>
<style>
/* body{width:610;} */
.demo-table {width: 100%;border-spacing: initial;opacity:80%;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #999;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#00d4ff;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>function highlightStar(obj,id) {
	removeHighlight(id);
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('highlight');
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;
		}
	});
}

function removeHighlight(id) {
	$('.demo-table #tutorial-'+id+' li').removeClass('selected');
	$('.demo-table #tutorial-'+id+' li').removeClass('highlight');
}

function addRating(obj,id) {
	$('.demo-table #tutorial-'+id+' li').each(function(index) {
		$(this).addClass('selected');
		$('#tutorial-'+id+' #rating').val((index+1));
		if(index == $('.demo-table #tutorial-'+id+' li').index(obj)) {
			return false;
		}
	});
	$.ajax({
	url: "add_rating.php",
	data:'id='+id+'&rating='+$('#tutorial-'+id+' #rating').val(),
	type: "POST"
	});
}

function resetRating(id) {
	if($('#tutorial-'+id+' #rating').val() != 0) {
		$('.demo-table #tutorial-'+id+' li').each(function(index) {
			$(this).addClass('selected');
			if((index+1) == $('#tutorial-'+id+' #rating').val()) {
				return false;
			}
		});
	}
} </script>

</HEAD>
	<body>
	    <h1 class="title">Visit Nepal</h1>
	  <div class="menu-wrap">
	    <input type="checkbox" class="toggler">
	    <div class="hamburger"><div></div></div>

	    <div class="menu">
	      <div>
	        <div>
	          <ul>
	            <li><h2>Preferences</h2></li>
	            <li><a href="nature.php">Nature</a></li>
	            <li><a href="adventure.php">Adventure </a></li>
	            <li><a href="culture.php">Culture</a></li>
	          </ul>
	        </div>
	      </div>
	    </div>
	  </div>

	  <header class="header">
	    <div class="container header-inner">
				<table class="demo-table">
				<tbody>
				<tr>
				<th><strong>Guides</strong></th>
				</tr>
				<?php
				if(!empty($result)) {
				$i=0;
				foreach ($result as $tutorial) {
				?>
				<tr>
				<td valign="top">
				<div class="feed_title"><?php echo $tutorial["title"]; ?></div>
				<div id="tutorial-<?php echo $tutorial["id"]; ?>">
				<input type="hidden" name="rating" id="rating" value="<?php echo $tutorial["rating"]; ?>" />
				<ul onMouseOut="resetRating(<?php echo $tutorial["id"]; ?>);">
				  <?php
				  for($i=1;$i<=5;$i++) {
				  $selected = "";
				  if(!empty($tutorial["rating"]) && $i<=$tutorial["rating"]) {
					$selected = "selected";
				  }
				  ?>
				  <li class='<?php echo $selected; ?>' onmouseover="highlightStar(this,<?php echo $tutorial["id"]; ?>);" onmouseout="removeHighlight(<?php echo $tutorial["id"]; ?>);" onClick="addRating(this,<?php echo $tutorial["id"]; ?>);">&#9733;</li>
				  <?php }  ?>
				<ul>
				</div>
				<div><?php echo $tutorial["description"]; ?></div>
				</td>
				</tr>
				<?php
				}
				}
				?>
				</tbody>
				</table>
	    </div>
	    <div class="nav-bar">
	      <div>
	        <div>
	          <ul class="list">
	            <li><a class = "links" href="index.php">Home</a></li>
	            <li><a class = "links" href="about.php">About</a></li>
	            <li><a class = "links" href="bttd.php">Best things to do </a></li>
	            <li><a class = "links" href="nepal_yatra.php">Nepal yatra</a></li>
							<li><a class = "links" href="index2.php">Our Guides</a></li>

	          </ul>
	        </div>
	      </div>
	    </div>
	  </div>
	  </header>
	</body>

</HTML>
