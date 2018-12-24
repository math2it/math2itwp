<div class="herald-menu-popup-search herald-login">
<span class="fa fa-user"></span>
	<div class="herald-in-popup">
		<?php 
			if ( !is_user_logged_in() ) : 
				$args = array(
					'label_username' => __herald( 'username_email_label' ),
					'label_password' => __herald( 'password_label' ),
					'label_remember' => __herald( 'remember_me' ),
					'label_log_in'   => __herald( 'log_in' ),
				);
			wp_login_form($args); 
		?>	
	
			<?php if ( get_option( 'users_can_register' ) ): ?>
				<a class="herald-registration-link" href="<?php echo wp_registration_url(); ?>"><?php echo __herald( 'registration_link' )?></a>
			<?php endif; ?>
			<a class="herald-lost-password-link" href="<?php echo wp_lostpassword_url(); ?>"><?php echo __herald( 'lost_password' )?></a>
		
		<?php else: ?>
			<?php 
			    
			    $current_user = wp_get_current_user();
				printf( '<div class="herald-avatar-logout">%s</div>', get_avatar( $current_user->ID, 64 ));				
			 	printf( '<p class="herald-username"><a href="%s">%s</a></p>', get_edit_profile_url($current_user->ID), esc_html( $current_user->user_login ));
				printf( '<a class="btn-logout" href="%s">' . __herald( 'log_out' ) . '</a>', wp_logout_url(home_url()));

			?>
		<?php endif; ?>
	</div>
</div>