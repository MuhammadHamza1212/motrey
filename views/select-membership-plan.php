<div class="container mt-5">
	<div class="row">
		<div class="col-lg-8 offset-lg-2">
			<div class="heading text-center mb-3"><?php echo $labels[$currentLanguageIsoCode]['Select_bundle_that_is_right_for_you']; ?></div>
			<?php
			$roleService = new RoleService();
			$dealerSeller = $roleService->getRoleByName('Dealer Seller');
			$privateSeller = $roleService->getRoleByName('Private Seller');
			
			$userRoleService = new UserRolesService();
			$userRoles = $userRoleService->getUserRolesByUserId($_SESSION['userId']);
			
			$membershipPlanService = new MembershipPlanService();
			$membershipPlans = null;
			foreach ($userRoles as $role) { 
				if($privateSeller->getRole_id() == $role->getRole_id()) {
					$membershipPlans = $membershipPlanService->getMembershipPlanByRoleId($role->getRole_id(), $currentLanguageIsoCode);
				}
				if($dealerSeller->getRole_id() == $role->getRole_id()) {
					$membershipPlans = $membershipPlanService->getMembershipPlanByRoleId($role->getRole_id(), $currentLanguageIsoCode);
					break;
				}
			}
			if($membershipPlans !== null) {
				echo '<div class="row mt-5">';
				foreach ($membershipPlans as $membershipPlan) { 
					echo '<div class="col-lg-4 mb-3">
						<div class="card membership-plan-card">
						  <div class="card-body">
							<h5 class="card-title text-center mb-4">'.$membershipPlan->getPlan_name().'</h5>
							<h6 class="card-subtitle mb-5 text-muted">'.$labels[$currentLanguageIsoCode]['Active_for_Unlimited_Time'].'</h6>
							<p class="card-text mb-4" style="font-size:25px;font-weight:bold">'.$currentCountry->getCurrency() . ' ' . $membershipPlan->getPlan_price().'*</p>';
							// Check if form data was stored in the session
							if (isset($_SESSION["form_data"]) && isset($_GET["category_id"])) {
								$category_id = $_GET["category_id"];
								$category_id_sal = $_GET["category_id_sal"];
								echo '<a href="submit-ad.php?category_id='.$category_id.'&plan_id='.$membershipPlan->getPlan_id().'&category_id_sal='.$category_id_sal.'" class="btn btn-outline-danger card-link d-block mb-4">'.$labels[$currentLanguageIsoCode]['Select'].' '.$membershipPlan->getPlan_name().'</a>';
							}
							else {
								echo '<a href="update-membership-plan?plan_id='.$membershipPlan->getPlan_id().'" class="btn btn-outline-danger card-link d-block mb-4">'.$labels[$currentLanguageIsoCode]['Select'].' '.$membershipPlan->getPlan_name().'</a>';
							}
							echo '<hr>
							<p class="card-text">'.$labels[$currentLanguageIsoCode]['No_of_Ads'].': '.$membershipPlan->getNo_of_ads().'</p>
							<p class="card-text">'.$labels[$currentLanguageIsoCode]['Ad_duration'].': '.$membershipPlan->getAd_duration().'</p>';
							if($membershipPlan->getAd_type() == 'Normal')
								echo '<p class="card-text">'.$labels[$currentLanguageIsoCode]['No_Featured_Ads'].'</p>';
							else
								echo '<p class="card-text">'.$labels[$currentLanguageIsoCode]['All_Featured_Ads'].'</p>';
						  echo '</div>
						</div>
					</div>';
				}
				echo '</div>';
			}
			?>
			<div class="mt-5 mb-4 text-center">*<?php echo $labels[$currentLanguageIsoCode]['5_VAT_will_be_charged']; ?></div>
		</div>
	</div>
</div>