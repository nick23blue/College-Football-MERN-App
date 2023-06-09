<footer>
		Copyright &copy; <?php echo date ("F d, Y @ g:i:s A", getlastmod()); ?> IT 3132 Web Programming
	</footer>
	
	<?php	
$filename = 'database.php';
if (file_exists($filename)) {
	$info= "$filename was last modified: " . date ("F d Y H:i:s.", filemtime($filename));
	echo "	<script>console.log('" . $info ."')</script>\n";
}
?>