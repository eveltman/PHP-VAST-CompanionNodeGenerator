<html>
<head>
  <title>VAST Companion Tag Generator</title>
</head>
<body>
	
	<!--  Creates this format:
	        <CompanionAds>
              <Companion width='300' height='60'>
                <IFrameResource creativeType='text/html'><![CDATA[http://localhost/companion.php]]>http://localhost/companion.php</IFrameResource>
                <HTMLResource>
                  <![CDATA[<iframe width='300' height='60' src='http://localhost/companion.php' frameborder=0 scrolling=no></iframe>]]>
                </HTMLResource>
              </Companion>
            </CompanionAds>
	-->
	
	<h2>VAST Companion Tag Generator</h2>
	
	<?php
	
	if (isset($_POST['addCompanion'])) {
	
		$tagURL = $_POST["tagURL"];
		$tagWidth = $_POST["tagWidth"];
		$tagHeight = $_POST["tagHeight"];
		$firstTag = $_POST["firstTag"];
		$nodeText = $firstTag."              <Companion width='".$tagWidth."' height='".$tagHeight."'>\n                <IFrameResource creativeType='text/html'><![CDATA[".$tagURL."]]></IFrameResource>\n                <HTMLResource>\n                  <![CDATA[<iframe width='".$tagWidth."' height='".$tagHeight."' src='".$tagURL."' frameborder=0 scrolling=no></iframe>]]>\n                </HTMLResource>\n              </Companion>\n";
		
		buildForm($tagURL, $tagWidth, $tagHeight, $nodeText);
		
	}else if (isset($_POST['generate'])) {
	
		$tagURL = $_POST["tagURL"];
		$tagWidth = $_POST["tagWidth"];
		$tagHeight = $_POST["tagHeight"];
		$nodeText = "            <CompanionAds>\n              <Companion width='".$tagWidth."' height='".$tagHeight."'>\n                <IFrameResource creativeType='text/html'><![CDATA[".$tagURL."]]></IFrameResource>\n                <HTMLResource>\n                  <![CDATA[<iframe width='".$tagWidth."' height='".$tagHeight."' src='".$tagURL."' frameborder=0 scrolling=no></iframe>]]>\n                </HTMLResource>\n              </Companion>\n";
		
		buildForm($tagURL, $tagWidth, $tagHeight, $nodeText);
		
	}else{
		buildForm("", "", "", "");		
	}	
	
	?>  
	
	<?php
	function buildForm($tagURL, $tagWidth, $tagHeight, $nodeText) {
		$nodeClosure = "";
	?>  
		<form method="post" action="<?php echo $PHP_SELF;?>">
			<p>VAST Version:
				<select name="formVersion">
				  <!--<option value="1">1.0</option>-->
				  <option value="2">2.0</option>
				  <!--<option value="3">3.0</option>-->
				</select>
			</p>
			<p>Tag URL:<input type="text" size="120" value="<?php echo $tagURL; ?>" name="tagURL"/></p>
			<p>Width:<input type="text" size="g" value="<?php echo $tagWidth; ?>" name="tagWidth"/></p>
			<p>Height:<input type="text" size="6" value="<?php echo $tagHeight; ?>" name="tagHeight"/></p>
			<?php
			if ($nodeText == "") {
				echo "<p><input type='submit' name='generate' value='Submit'/></p>";
			}else{
				$nodeClosure = "            </CompanionAds>";
			?>				
				<input type="hidden" value="<?php echo $nodeText; ?>" name="firstTag"/>		
				<p>
					<input type="submit" name="addCompanion" value="Add Another Companion" />
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="submit" name="clear" value="Clear All" />
				</p>
			<?php
			}
			?>  
		</form>
		<br/><textarea rows="20" cols="150"><?php echo $nodeText; echo $nodeClosure; ?></textarea>
	<?php
	}
	?>  
	
</body>
</html>