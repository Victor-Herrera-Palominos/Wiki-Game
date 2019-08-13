<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$this->load->helper('form');
?><!DOCTYPE html>
<!-- Author: Victor H-->
<html lang="en">
<head>
	<link href="<?php echo base_url('/public/css/mainstyle.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('/public/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<script type='text/javascript' src="<?php echo base_url('/public/js/angular.min.js'); ?>"></script>
	<script type='text/javascript' src="<?php echo base_url('/public/js/wikijs.js'); ?>"></script>
	<meta charset="utf-8">
	<title>Wikipedia Game</title>
</head>
<body>
	<h1>The Wikipedia Game</h1>	
	<div id="body" ng-app="wikiGame" ng-controller="wikiCtrl">
		<p>Starting at your chosen Wikipedia article, you have to get to a randomly selected article using only Wikipedia links contained in each page.</p>
		<!--Has input for article name and the number of (randomly picked) articles to get to the end
		Has error messages for when article doesn't exist, or a number isn't inputted
		Buttons have tooltips explaining what they mean
		-->
		<label>Article Name: </label>
		<input type="text" name="starttitle" ng-model="startTitle" />
		<span class="errorMessages" ng-init="articleError = true" ng-hide="articleError">Article with this name doesn't exist</span>
		<br><br>
		<input type="text" id="indegrees" name="indegrees" ng-model="inputDegrees" maxlength="1">
		<div class="customtooltip"> 
			<button ng-click="degreeRandom()">Degrees of Random</button>
			<span class="tooltiptext">Chooses random link within article, jumps to it, and repeats</span>
		</div>
		<div class="customtooltip"> <button ng-click="fullRandom()">Fully Random</button>
			<span class="tooltiptext">Chooses any random article across all of Wikipedia</span>
		</div>
		<span class="errorMessages" ng-init="degError = true" ng-hide="degError">Degree has to be a number over 0</span>
		<br><br>
		<!--hyperlink div appears when one fo the above buttons have been pressed-->
		<div name="hyperlink" ng-hide="linkDest" ng-init="linkDest = true">
			Destination: <a ng-href="https://en.wikipedia.org/wiki/{{endTitle}}" target="_blank">{{endTitle}}</a>
		</div>
		<br>
		<!--Shows ArticleStart->Article2->...->ArticleEnd path/trace-->
		<span class="pathtext">{{linkPath}}</span>
		<br><br>
		<!--Where user inputs next article within the current article. 
			Dropdown menu items use ng-mosuedown because it's faster than ng-click(triggers after release)
			This is to get ahead of the hiding(hideDrop) of the dropdown menu
		-->
		<div ng-init="hideLink = false" ng-hide="hideLink">
			<input type="text" name="nextlink" id="nextlink" ng-model="nextTitle" ng-keyup="autoComp(nextTitle)" placeholder="Next Link" class="form-control" ng-focus="onFocus()" ng-blur="onBlur()"/>
			<button name="selectlink" ng-click="nextLink()">Select</button>	
			<span class="errorMessages" ng-init="nextError = true" ng-hide="nextError">Article doesn't reference this</span>
			<br>
			<ul class="list-group pre-scrollable" ng-hide="hideDrop">
				<li class="list-group-item" ng-repeat="foundTitle in dropDown" ng-mousedown="selectTitle(foundTitle)">{{foundTitle}}</li>
			</ul>
		</div>
		<!--Form to store in DB, can only be sent once button appears, when the end article has been reached-->
		<?php echo form_open('main/saveresult'); ?>
			<input id="path" name="path" type="hidden" value="{{linkPath}}">
			<input type="text" name="user" id="user" ng-init="storeDB = true" ng-hide="storeDB" placeholder="(Optional) Your Name"/>
			<input type="submit" class="submit_btn float_l" ng-hide="storeDB" name="storedb" value="Save Result" />
		</form>
	</div>
	<br>
	<!--Link to what's been stored in the database-->
	<div class="jumppage">
		<a href="<?php echo site_url('main/viewresults'); ?>">List of Completed Games</a>
	</div>
</body>
</html>