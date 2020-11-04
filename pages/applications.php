
<!DOCTYPE html>
<html>
	<body>
		<div class="container py-5">
			<?php foreach($ucp_user->GetApplications() as $application) { ?>
				<a href="app/<?php echo $application['id']; ?>"><button type="button" class="collapsible"><?php echo $application['username']; ?></button>
				<div class="content">
					<p><?php echo $application['question_1']; ?><br><?php echo $application['question_2']; ?></p>
				</div>
				</a><?php } ?>
		</div>
		<script>
			var coll = document.getElementsByClassName("collapsible");
			var i;
			for (i = 0; i < coll.length; i++) {
			coll[i].addEventListener("click", function() {
				this.classList.toggle("active");
				var content = this.nextElementSibling;
				if (content.style.display === "block") {
					content.style.display = "none";
				} else {
					content.style.display = "block";
				}
			});
			}
		</script>
	</body>
</html>
