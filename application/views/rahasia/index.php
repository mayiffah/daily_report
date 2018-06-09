<h2><?php echo $title; ?></h2>

<?php foreach ($rahasia as $kumpulan_rahasia): ?>
	<h3><?php echo $kumpulan_rahasia['title']; ?></h3>
	<div class = "main">
		<?php echo $kumpulan_rahasia['text']; ?>
	</div>
<?php endforeach; ?>