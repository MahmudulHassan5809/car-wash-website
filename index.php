<?php include 'inc/header.php'; ?>

	<h1>Hello</h1> <?php echo Session::get('userName'); ?>
	<?php $data = unserialize($_COOKIE['user']); echo $data['full_name']; ?>

	<a href="<?php echo(URLROOT);?>/logout.php?action=logout">LogOut</a>

<?php include 'inc/footer.php'; ?>
