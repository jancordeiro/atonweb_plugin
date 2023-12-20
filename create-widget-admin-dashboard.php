// Make a widget on a Wordpress admin dashboard
// Cria um widget no painel administrativo do Wordpress

function atonweb_dashboard_widget() {
	echo '<p>Olá, seja bem-vindo ao Painel ATON.</p>';
	echo '<p>Acesse <a href="https://atonweb.xyz/" target="_blank">nosso site</a> mais informações e suporte.</p>';
}

function atonweb_add_dashboard_widget() {
	add_meta_box('id', 'ATON WEB', 'atonweb_dashboard_widget', 'dashboard', 'side', 'high');
}

add_action('wp_dashboard_setup', 'atonweb_add_dashboard_widget' );
