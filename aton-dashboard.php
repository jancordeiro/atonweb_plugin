<?php
/**
 * ATON WEB DEVELOPMENT
 * 
 * Custom dashboard widgets for Wordpress CMS
 * 
 * Developer: Jan Cordeiro - https://jancordeiro.github.io
 */

// ATON WEB DASHBOARD WIDGET
function aton_quicklinks_widget() {
    ?>
    <div class="custom-dashboard-widget">
        <h2><i class="dashicons dashicons-store"></i> MEU SITE</h2>
        <a href="post-new.php?post_type=product" class="button button-primary button-large"><i class="dashicons dashicons-cart"></i> Cadastrar Produto</a>
        <a href="edit.php?post_type=product" class="button button-primary button-large"><i class="dashicons dashicons-text-page"></i> Editar Produtos</a>
		<a href="post-new.php?post_type=shop_coupon" class="button button-primary button-large"><i class="dashicons dashicons-tickets-alt"></i> Cadastrar Cupom</a>
		<a href="edit.php?post_type=shop_coupon" class="button button-primary button-large"><i class="dashicons dashicons-tickets-alt"></i> Editar Cupons</a>
        <a href="admin.php?page=wc-reports" class="button button-primary button-large"><i class="dashicons dashicons-chart-bar"></i> Relatórios da Loja</a>

        <h2><i class="dashicons dashicons-admin-home"></i> ADMIN</h2>
        <a href="profile.php" class="button button-secondary"><i class="dashicons dashicons-admin-users"></i> Meu Perfil</a>
        <a href="users.php" class="button button-secondary"><i class="dashicons dashicons-groups"></i> Gerenciar Usuários</a>
        <a href="https://wa.me/5542999501519" class="button button-secondary" target="_blank"><i class="dashicons dashicons-whatsapp"></i> Suporte Técnico</a>
    </div>
    <?php
}

// ADD ATON WEB WIDGET INTO DASHBOARD
function add_aton_quicklinks_widget() {
    wp_add_dashboard_widget(
        'aton_quicklinks_widget',
        'Aton WEB - Painel',
        'aton_quicklinks_widget'
    );
}
add_action('wp_dashboard_setup', 'add_aton_quicklinks_widget');

// ATON VIDEO WIDGET
function aton_video_widget(){
	echo '<center><iframe width="400" height="225" src="https://www.youtube.com/embed/vTM3sytSzmk?si=vIQSDmQqc5ncCOn9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></center>';
	/*?>
	<iframe width="400" height="225" src="https://www.youtube.com/embed/vTM3sytSzmk?si=vIQSDmQqc5ncCOn9" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
	<?php*/
}
// ADD ATON VIDEO WIDGET
function add_aton_video_widget(){
	wp_add_dashboard_widget('aton_video_widget', 'Aton Informativo', 'aton_video_widget');
}
add_action('wp_dashboard_setup', 'add_aton_video_widget');