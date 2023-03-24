<div class="container mt-5">
	<div class="row">
		<div class="col-lg-4 offset-lg-4">
			<div class="heading text-center "><?php echo $labels[$currentLanguageIsoCode]['Choose_right_Category_for_ad']; ?></div>
			<div class="row border-bottom py-3">
				<div class="fw-bold" style="color:#777; font-size:13px;"><?php echo $categoryName ?></div>
			</div>
			<?php
			foreach ($subCategories as $value) { 
				echo '<a href="place-an-ad.php?category_id=' . $value->getCategory_id() . '&category_id_sal='.$value->getCategory_id_sal().'" class="row border-bottom py-3 text-decoration-none text-reset">
						<div class="col-11">
							<div class="fw-bold">' . $value->getName() . '</div>
						</div>
						<div class="col-1">
							<div><i class="fa fa-arrow-right" aria-hidden="true"></i></div>
						</div>
					  </a>';
			}
			?>
		</div>
	</div>
</div>