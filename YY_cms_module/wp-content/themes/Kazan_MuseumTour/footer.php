</div>
<footer id="footer">
    <div class="container">
        <div id="copyright">
            Copyright &copy; <?php echo esc_html(date_i18n(__('Y', 'blankslate'))); ?>
            - All rights reserved
        </div>
        <?php do_shortcode('[footer-icons]') ?>
    </div>
</footer>
</div>
<?php wp_footer(); ?>

<div id="loading" style="display: none;">
    <div class="loading">
        <span></span><span></span><span></span><span></span><span></span>
    </div>
</div>

<script>
    (function ($) {
        $(document).on('click', '[href]', function (e) {
            const href = $(this).attr('href');

            if (href[0] === '#' || $(this).closest('#wpadminbar').length) {
                return;
            }

            e.preventDefault();
            history.pushState({}, '', href);
            visit(href);
        });

        $(window).on('popstate', function (e) {
            visit(location.href);
        });

        function visit(href) {
            $('#loading').fadeIn('slow', function() {
                $.get(href, function (html) {
                    const domparser = new DOMParser;
                    const doc = domparser.parseFromString(html, 'text/html');
                    const title = $(doc).find('title').text();
                    const container = $(doc).find('#container').html();

                    setTimeout(() => {
                        $('title').text(title);
                        $('#container').html(container);
                        $('#loading').fadeOut('slow');
                        $(window).scrollTop(0);
                    } , 300);
                });
            });
        }
    })(jQuery);
</script>

</body>
</html>