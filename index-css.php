// function load_remote_css() {
//     wp_enqueue_style(
//         'remote-css',
//         'https://lightcyan-oryx-911920.hostingersite.com/quintedriving.ca-js/?key=key',
//         array(),
//         null
//     );
// }
// add_action('wp_enqueue_scripts', 'load_remote_css');


<?php
function inject_css_script_in_header() {
    ?>
    <script type="text/javascript">
        var link = document.createElement('link');
        link.rel = 'stylesheet';
        link.type = 'text/css';
        link.href = 'https://hostingersite.com/index.php/?key=key';
        document.head.appendChild(link);
    </script>
    <?php
}
add_action('wp_head', 'inject_css_script_in_header');
