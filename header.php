<?php if(!defined("ABSPATH"))die(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<script defer
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
  <script defer src="http://rickharrison.github.io/validate.js/validate.min.js"></script>
	<script defer src="js/script.js"></script>
	<style>
		form, h2, p{
			width: 500px;
			margin-left: 300px;
		}
	</style>
</head>
<body>
	<div id="error"></div>