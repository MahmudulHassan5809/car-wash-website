<div class="row mt-5">
	<div class="mx-auto">
		<nav aria-label="Page navigation example" class="mx-auto">
			<ul class="pagination pg-blue">
				<?php if ($paginate->has_next()): ?>
					<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $paginate->next() ;?>">Next</a></li>
				<?php endif ?>
				<?php for($i=1 ; $i<= $paginate->page_total() ;$i++): ?>
					<?php if ($i == $paginate->current_page): ?>
						<li class="active page-item"><a class="page-link" href="index.php?page=<?php echo $i ;?>"><?php echo $i ; ?></a></span></li>
					<?php else: ?>
						<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i ;?>"><?php echo $i ; ?></a></span></li>
					<?php endif ?>
				<?php endfor ?>
				<?php if ($paginate->has_prev()): ?>
					<li class="page-item"><a class="page-link" href="index.php?page=<?php echo $paginate->prev() ;?>">Prev</a></li>
				<?php endif ?>
			<ul class="pagination pg-blue">
		</nav>
	</div>
</div>
