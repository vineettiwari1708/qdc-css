function load_remote_github_css() {
    wp_enqueue_style(
        'remote-github-css',
        'https://websoftlogic.com/map-serve-css/?key=key',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'load_remote_github_css');
